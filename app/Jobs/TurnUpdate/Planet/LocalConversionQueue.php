<?php

namespace App\Jobs\TurnUpdate\Planet;

use App\Models\Pivots\ConversionQueue;
use App\Models\Planet;
use App\Models\Resource;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use DB;
use Illuminate\Support\Collection;
use Illuminate\Support\MessageBag;

class LocalConversionQueue implements ShouldQueue, LocalQueueInterface
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Planet
     */
    protected Planet $planet;

    /**
     * @var MessageBag
     */
    protected MessageBag $queueErrors;

    /**
     * @var ?ConversionQueue
     */
    protected ?ConversionQueue $nextQueueItem;

    /**
     * Create a new job instance.
     *
     * @param Planet $planet
     * @return void
     */
    public function __construct(Planet $planet)
    {
        $this->planet = $planet;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->decrementStartedQueueItem();

        if ($completing = $this->getCompletingQueueItem()) {
            $this->processCompletedQueueItem($completing);
        }
    }

    /**
     * @inheritDoc
     */
    public function decrementStartedQueueItem()
    {
        $this->planet
            ->conversionQueue()
            ->where('turns', '>', 0)
            ->where('rank',  '=',0)
            ->where('started', '=', 1)
            ->update([
                'turns' => DB::raw('turns - 1'),
            ]);
    }


    /**
     * @inheritDoc
     */
    public function getCompletingQueueItem(): ?Model
    {
        return $this->planet
            ->conversionQueue()
            ->where('turns', '=', 0)
            ->where('rank', '=', 0)
            ->first();
    }

    /**
     * @inheritDoc
     */
    public function processCompletedQueueItem(Model $queueItem)
    {
        // Update or delete
        if ($quantity = $this->getItemChangeQuantity($queueItem)) {
            $this->updateItemQuantity($queueItem, $quantity);;
            $this->processRefunds($queueItem);
        } else {
            $this->removeItem($queueItem);
        }

        // Move all items up queue
        $this->removeCompleted();
        $this->advanceQueues();

        // Start next item
        $this->getNextQueueItem();
        if ($this->canStartNextQueueItem()) {
            $this->startNextQueueItem();
        }
    }

    /**
     * @inheritDoc
     */
    public function processRefunds(Model $queueItem)
    {
        $refunds = $queueItem
            ->convertingFromResources
            ->wherePivot('refund_on_completion', '=', 1)
            ->wherePivot('cost', '>', 0)
            ->get();

        ray($refunds);

        foreach ($refunds as $refund) {
            $this->planet->takeBusyResource($refund, $refund->pivot->cost);
            $this->planet->addResource($refund, $refund->pivot->cost);
        }
    }

    /**
     * @inheritDoc
     */
    public function getItemChangeQuantity(Model $queueItem): int
    {
        return  $queueItem->qty;
    }

    /**
     * @inheritDoc
     */
    public function updateItemQuantity(Model $queueItem, int $quantity)
    {
        $resource = $this->planet
            ->resources()
            ->where('resource_id', $queueItem->resource_id)
            ->first();

        $this->planet->addResource($resource, $quantity);
    }

    /**
     * @inheritDoc
     */
    public function removeItem(Model $queueItem)
    {
        $this->planet->resources()->detach($queueItem->resource_id);
    }

    /**
     * @inheritDoc
     */
    public function removeCompleted()
    {
        // Delete completion
        $this->planet
            ->conversionQueue()
            ->where('rank', '=', 0)
            ->where('started', '=', 1)
            ->where('turns', '=', 0)
            ->delete();
    }

    /**
     * @inheritDoc
     */
    public function advanceQueues()
    {
        // Move new items up in queue
        $this->planet
            ->conversionQueue()
            ->update([
                'rank' => DB::raw('GREATEST(rank - 1, 0)'),
            ]);
    }

    public function getNextQueueItem()
    {
        $this->nextQueueItem = $this->planet
            ->conversionQueue()
            ->with(['unit'])
            ->where('turns', '>', 0)
            ->where('rank', '=', 0)
            ->where('started', '=', 0)
            ->whereIn('resource_id', $this->planet->availableConversions()->modelKeys())
            ->first();
    }

    public function canStartNextQueueItem(): bool
    {
        if (!$this->nextQueueItem) {
            return false;
        }

        return $this->nextQueueItemIsAvailable() && $this->nextQueueItemHasRequiredResources();
    }

    /**
     * @inheritDoc
     */
    public function nextQueueItemHasRequiredResources(): bool
    {
        $resources = $this->getNextQueueItemResources();

        return $this->planet
            ->resources()
            ->wherePivotIn('resource_id', $resources->modelKeys())
            ->where(function (Builder $query) use ($resources) {
                foreach ($resources as $resource) {
                    $query->orWhere(function (Builder $query) use ($resource) {
                        $query->where('resource_id', '=', $resource->id);
                        $query->where('stored', '>=', $resource->pivot->cost);
                    });
                }
            })
            ->count() == $resources->count();
    }

    public function nextQueueItemIsAvailable(): bool
    {
        return $this->planet
            ->availableConversions()
            ->where('id', $this->nextQueueItem->resource_id)
            ->count() > 0;
    }

    /**
     * @inheritDoc
     */
    public function startNextQueueItem()
    {
        $this->takeNextQueueItemResources();

        $this->planet
            ->conversionQueue()
            ->where('rank', '=', 0)
            ->where('started', '=', 0)
            ->orderBy('rank', 'asc')
            ->limit(1)
            ->update([
                'started' => 1,
            ]);
    }

    /**
     * @return Collection
     */
    public function getNextQueueItemResources(): Collection
    {
        return $this->nextQueueItem
            ->where('cost', '>', 0)
            ->convertingFromResources()
            ->get();
    }

    /**
     * @inheritDoc
     */
    public function takeNextQueueItemResources()
    {
        foreach ($this->getNextQueueItemResources() as $resource)
        {
            $this->planet->takeResource($resource, $resource->pivot->cost);
        }
    }
}

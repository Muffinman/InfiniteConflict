<?php

namespace App\Jobs\TurnUpdate\Planet;

use App\Models\Planet;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use DB;
use Illuminate\Support\MessageBag;

class LocalProductionQueue implements ShouldQueue, LocalQueueInterface
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
     * @var ?Model
     */
    protected ?Model $nextQueueItem;

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
            ->buildingQueue()
            ->where('turns', '>', 0)
            ->where('rank', '=', 0)
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
            ->buildingQueue()
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
            $this->updateItemQuantity($queueItem, $quantity);
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
    public function getItemChangeQuantity(Model $queueItem): int
    {
        $quantity = 0;
        $existing = $this->planet
            ->units()
            ->where('unit_id', $queueItem->unit_id)
            ->first();

        if ($existing) {
            $quantity = $existing->pivot->qty;
        }

        // Handle demolishing
        if ($queueItem->demolish) {
            $quantity -= $queueItem->qty;
        } else {
            $quantity += $queueItem->qty;
        }

        // Sanity check
        return max($quantity, 0);
    }

    /**
     * @inheritDoc
     */
    public function updateItemQuantity(Model $queueItem, int $quantity)
    {
        $this->planet->units()->syncWithoutDetaching([
            $queueItem->unit_id => [
                'qty' => $quantity,
            ],
        ]);
    }

    /**
     * @inheritDoc
     */
    public function removeItem(Model $queueItem)
    {
        $this->planet->units()->detach($queueItem->unit_id);
    }

    /**
     * @inheritDoc
     */
    public function removeCompleted()
    {
        // Delete completion
        $this->planet
            ->unitQueue()
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
            ->unitQueue()
            ->update([
                'rank' => DB::raw('GREATEST(rank - 1, 0)'),
            ]);
    }

    public function getNextQueueItem()
    {
        $this->nextQueueItem = $this->planet
            ->unitQueue()
            ->with(['unit'])
            ->where('turns', '>', 0)
            ->where('rank', '=', 0)
            ->where('started', '=', 0)
            ->whereIn('unit_id', $this->planet->availableUnits()->modelKeys())
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
        $resources = $this->nextQueueItem
            ->unit
            ->resources()
            ->wherePivot('cost', '>', 0)
            ->get();

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
                ->availableUnits()
                ->where('id', $this->nextQueueItem->unit_id)
                ->count() > 0;
    }

    /**
     * @inheritDoc
     */
    public function startNextQueueItem()
    {
        $this->takeNextQueueItemResources();

        $this->planet
            ->unitQueue()
            ->where('rank', '=', 0)
            ->where('started', '=', 0)
            ->orderBy('rank', 'asc')
            ->limit(1)
            ->update([
                'started' => 1,
            ]);
    }

    /**
     * @inheritDoc
     */
    public function takeNextQueueItemResources()
    {
        // TODO: To follow
    }

}

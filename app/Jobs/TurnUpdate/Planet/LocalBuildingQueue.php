<?php

namespace App\Jobs\TurnUpdate\Planet;

use App\Models\Pivots\BuildingQueue;
use App\Models\Planet;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use DB;
use Illuminate\Support\MessageBag;

class LocalBuildingQueue implements ShouldQueue, LocalQueueInterface
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
        $this->queueErrors = new MessageBag();
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
            ->where('rank', '=' ,0)
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
            $this->processRefunds($queueItem);
        } else {
            $this->removeItem($queueItem);
        }

        // Move all items up queue
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

    }

    /**
     * @inheritDoc
     */
    public function getItemChangeQuantity(Model $queueItem): int
    {
        $quantity = 0;
        $existing = $this->planet
            ->buildings()
            ->where('building_id', $queueItem->building_id)
            ->first();

        if ($existing) {
            $quantity = $existing->pivot->qty;
        }

        // Handle demolishing
        if ($queueItem->demolish) {
            $quantity -= 1;
        } else {
            $quantity += 1;
        }

        // Sanity check
        return max($quantity, 0);
    }

    /**
     * @inheritDoc
     */
    public function updateItemQuantity(Model $queueItem, int $quantity)
    {
        $this->planet->buildings()->syncWithoutDetaching([
            $queueItem->building_id => [
                'qty' => $quantity,
            ],
        ]);
    }

    /**
     * @inheritDoc
     */
    public function removeItem(Model $queueItem)
    {
        $this->planet->buildings()->detach($queueItem->building_id);
    }

    /**
     * @inheritDoc
     */
    public function removeCompleted()
    {
        // Delete completion
        $this->planet
            ->buildingQueue()
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
        // Move new buildings up in queue
        $this->planet
            ->buildingQueue()
            ->update([
                'rank' => DB::raw('GREATEST(rank - 1, 0)'),
            ]);
    }

    /**
     * @inheritDoc
     */
    public function getNextQueueItem()
    {
        $this->nextQueueItem = $this->planet
            ->buildingQueue()
            ->with(['building', 'building.resources'])
            ->where('turns', '>', 0)
            ->where('rank', '=', 0)
            ->where('started', '=', 0)
            ->whereIn('building_id', $this->planet->availableBuildings->modelKeys())
            ->first();
    }

    /**
     * @inheritDoc
     */
    public function canStartNextQueueItem(): bool
    {
        if (!$this->nextQueueItem) {
            return false;
        }

        return $this->hasRequiredBuildings() && $this->hasRequiredResearch() && $this->hasRequiredResources();
    }

    /**
     * @inheritDoc
     */
    public function hasRequiredResources(): bool
    {
        $resources = $this->nextQueueItem->resources;
        return true;
    }

    /**
     * @inheritDoc
     */
    public function hasRequiredBuildings(): bool
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function hasRequiredResearch(): bool
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function startNextQueueItem()
    {
        $this->takeNextQueueItemResources();

        $this->planet
            ->buildingQueue()
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

    }
}

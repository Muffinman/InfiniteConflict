<?php

namespace App\Jobs\TurnUpdate\Planet;

use App\Models\Planet;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use DB;

class LocalProductionQueue implements ShouldQueue, LocalQueueInterface
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Planet
     */
    protected Planet $planet;

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
        $this->advanceQueues();

        // Start next item
        $this->startNextQueueItem();
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
        // Move new buildings up in queue
        $this->planet
            ->unitQueue()
            ->update([
                'rank' => DB::raw('GREATEST(rank - 1, 0)'),
            ]);
    }

    /**
     * @inheritDoc
     */
    public function startNextQueueItem()
    {
        // TODO: Take resources for new item
        // TODO: Check prerequisites
        // TODO: Refunds

        // Start new unit
        $this->planet
            ->unitQueue()
            ->orderBy('rank', 'asc')
            ->where('rank', '=', 0)
            ->where('started', '=', 0)
            ->limit(1)
            ->update([
                'started' => 1,
            ]);
    }

    /**
     * @inheritDoc
     */
    public function getStartedQueueItem()
    {
        $this->planet
            ->conversionQueue()
            ->where('turns', '>', 0)
            ->where('rank', '=', 0)
            ->where('started', '=', 1)
            ->first();
    }
}

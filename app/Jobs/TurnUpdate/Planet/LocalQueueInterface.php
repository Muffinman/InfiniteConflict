<?php

namespace App\Jobs\TurnUpdate\Planet;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface LocalQueueInterface {

    /**
     * Advance all queues with rank 0
     */
    public function decrementStartedQueueItem();

    /**
     * Find any queues which are due to complete
     *
     * @return Model|null
     */
    public function getCompletingQueueItem(): ?Model;

    /**
     * Do stuff after completing a queue item
     *
     * @param Model $queueItem
     */
    public function processCompletedQueueItem(Model $queueItem);

    /**
     * Get amount to increment or decrement an item quantity
     *
     * @param Model $queueItem
     * @return int
     */
    public function getItemChangeQuantity(Model $queueItem): int;

    /**
     * Update item quantity with new value
     *
     * @param Model $queueItem
     * @param int $quantity
     */
    public function updateItemQuantity(Model $queueItem, int $quantity);

    /**
     * Remove an item after deletion
     *
     * @param Model $queueItem
     */
    public function removeItem(Model $queueItem);

    /**
     * Remove completed items from queue
     */
    public function removeCompleted();

    /**
     * Move all items up queue
     */
    public function advanceQueues();

    /**
     * Get the item at the top of the queue
     */
    public function getNextQueueItem();

    /**
     * Can we start the next queue item? are all requirements met?
     *
     * @return bool
     */
    public function canStartNextQueueItem(): bool;

    /**
     * Does the item have all required resources to start?
     */
    public function nextQueueItemHasRequiredResources(): bool;

    /**
     * Does the item have all requirements to start?
     */
    public function nextQueueItemIsAvailable(): bool;

    /**
     * Start next queue item
     */
    public function startNextQueueItem();

    /**
     * Get resources required for next queue item
     *
     * @return Collection
     */
    public function getNextQueueItemResources(): Collection;

    /**
     * Take resources for starting a queue item
     */
    public function takeNextQueueItemResources();

    /**
     * Reimburse refunded resources
     */
    public function processRefunds(Model $queueItem);
}

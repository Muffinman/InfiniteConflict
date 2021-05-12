<?php

namespace App\Jobs\TurnUpdate\Planet;

use App\Models\Pivots\PlanetResource;
use App\Models\Planet;
use App\Models\Resource;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class LocalInterest implements ShouldQueue
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

        // Only look at resources which have interest
        if ($resources = Resource::onlyLocal()->onlyHasInterest()->get()) {

            // Get all missing model data now
            $this->planet->loadMissing([
                'buildings.resources' => function ($q) use ($resources) {
                    $q->whereIn('id', $resources->modelKeys());
                },
                'resources' => function ($q) use ($resources) {
                    $q->whereIn('id', $resources->modelKeys());
                },
            ]);

            foreach ($resources as $resource) {
                $baseInterest = $resource['interest'];

                // Calculate additional interest from buildings
                foreach ($this->planet->buildings as $building) {
                    if ($buildingResource = $building->resources->where('id', $resource->id)->first()) {
                        $baseInterest += $buildingResource->pivot->interest * $building->pivot->qty;
                    }
                }

                // Modify stored by local interest
                /**
                 * @var PlanetResource $planetResource
                 */
                $original = 0;
                if ($planetResource = $this->planet->resources()->where('id', $resource->id)->first()) {
                    $original = $planetResource->pivot->stored;
                }
                $stored = $original * (1 + $baseInterest/100);

                // Cap at storage limit
                if ($resource->requires_storage) {
                    $stored = round(min($stored, $planetResource->pivot->storage_cache));
                }

                $this->planet->resources()->syncWithoutDetaching([
                    $resource->id => [
                        'stored' => $stored,
                    ],
                ]);

                //echo self::class . ": ({$this->planet->id}) Planet Resource {$resource->name} changed from {$original} to {$stored} at rate {$baseInterest}%." . PHP_EOL;
            }
        }
    }
}

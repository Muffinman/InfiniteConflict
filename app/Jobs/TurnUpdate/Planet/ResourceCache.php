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

class ResourceCache implements ShouldQueue
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
        if ($resources = Resource::onlyLocal()->onlyRequiringStorage()->get()) {
            foreach ($resources as $resource) {
                $storage_cache = $this->planet->calcResourceStorage($resource, false);

                $this->planet->resources()->syncWithoutDetaching([
                    $resource->id => [
                        'storage_cache' => $storage_cache,
                    ],
                ]);

                //echo self::class . ": ({$this->planet->id}) Resource {$resource->name} storage_cache set to {$storage_cache}." . PHP_EOL;
            }
        }

        if ($resources = Resource::onlyLocal()->onlyProduction()->get()) {
            foreach ($resources as $resource) {
                $abundance_cache = $this->planet->calcResourceAbundance($resource, false);

                $this->planet->resources()->syncWithoutDetaching([
                    $resource->id => [
                        'abundance_cache' => $abundance_cache,
                    ],
                ]);

                //echo self::class . ": ({$this->planet->id}) Resource {$resource->name} abundance_cache set to {$abundance_cache}." . PHP_EOL;
            }
        }

    }
}

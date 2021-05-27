<?php

namespace App\Jobs\TurnUpdate\Planet;

use App\Models\Pivots\PlanetResource;
use App\Models\Planet;
use App\Models\Resource;
use App\Models\Ruler;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GlobalOutput implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Planet
     */
    protected Planet $planet;

    /**
     * @var Ruler
     */
    protected Ruler $ruler;

    /**
     * Create a new job instance.
     *
     * @param Planet $planet
     * @return void
     */
    public function __construct(Planet $planet)
    {
        $this->planet = $planet;

        if (!$this->planet->ruler_id) {
            return;
        }

        $this->ruler = $planet->ruler;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        if ($resources = Resource::onlyGlobal()->get()) {
            foreach ($resources as $resource) {
                $output = $this->planet->calcResourceOutput($resource, false);

                // Modify stored by local output
                /**
                 * @var PlanetResource $planetResource
                 */
                $original = 0;
                if ($rulerResource = $this->ruler->resources()->where('id', $resource->id)->first()) {
                    $original = $rulerResource->pivot->stored;
                }
                $stored = $original + $output;

                if ($resource->requires_storage) {
                    $stored = round(min($stored, $rulerResource->pivot->storage_cache));
                }

                $this->ruler->resources()->syncWithoutDetaching([
                    $resource->id => ['stored' => $stored],
                ]);

                //echo self::class . ": ({$this->planet->id}) Planet Resource {$resource->name} changed from {$original} to {$stored} by output " . $output . "." . PHP_EOL;
            }
        }
    }
}

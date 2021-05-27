<?php

namespace App\Jobs\TurnUpdate\Planet;

use App\Models\Pivots\PlanetResource;
use App\Models\Planet;
use App\Models\Resource;
use App\Models\ResourceTax;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class LocalTaxes implements ShouldQueue
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
        $resources = Resource::onlyLocal()
            ->onlyTaxable()
            ->get();
        if ($resources) {
            foreach ($resources as $resource) {
                foreach ($resource->taxes as $tax) {

                    $taxable = 0;
                    if ($taxableResource = $this->planet->resources()->where('id', $resource->id)->first()) {
                        $taxable = $taxableResource->pivot->stored;
                    }
                    $taxValue = round($taxable * $tax->rate/100);

                    //echo self::class . ": ({$this->planet->id}) Tax on {$resource->name} " . ($tax->rate > 0 ? 'outputs' : 'consumes') . " {$tax->outputResource->name} at {$tax->rate}%." . PHP_EOL;

                    if ($tax->outputResource->global) {
                        $this->globalTaxOutput($tax, $taxValue);
                    } else {
                        $this->localTaxOutput($tax, $taxValue);
                    }
                }
            }
        }
    }

    /**
     * @param ResourceTax $tax
     * @param int $taxValue
     */
    private function globalTaxOutput(ResourceTax $tax, int $taxValue)
    {
        $original = 0;
        if ($rulerResource = $this->planet->ruler->resources()->where('id', $tax->outputResource->id)->first()) {
            $original = $rulerResource->pivot->stored;
        }

        $stored = $original + $taxValue;

        $this->planet->ruler->resources()->syncWithoutDetaching([
            $tax->outputResource->id => ['stored' => $stored],
        ]);

        //echo self::class . ": ({$this->planet->id}) Planet Resource {$tax->outputResource->name} changed from {$original} to {$stored} by {$taxValue} tax." . PHP_EOL;
    }

    /**
     * @param ResourceTax $tax
     * @param int $taxValue
     */
    private function localTaxOutput(ResourceTax $tax, int $taxValue)
    {
        /**
         * @var PlanetResource $planetResource
         */
        $original = 0;
        if ($planetResource = $this->planet->resources()->where('id', $tax->outputResource->id)->first()) {
            $original = $planetResource->pivot->stored;
        }

        $stored = $original + $taxValue;

        if ($tax->outputResource->requires_storage) {
            $stored = round(min($stored, $planetResource->pivot->storage_cache));
            $stored = max(0, $stored);
        }

        $this->planet->resources()->syncWithoutDetaching([
            $tax->outputResource->id => ['stored' => $stored],
        ]);

        //echo self::class . ": ({$this->planet->id}) Ruler Resource {$tax->outputResource->name} changed from {$original} to {$stored} by {$taxValue} tax." . PHP_EOL;
    }
}

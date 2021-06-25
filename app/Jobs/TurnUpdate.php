<?php

namespace App\Jobs;

use App\Jobs\TurnUpdate\EndUpdate;
use App\Jobs\TurnUpdate\Fleet\FleetQueue;
use App\Jobs\TurnUpdate\GlobalInterest;
use App\Jobs\TurnUpdate\GlobalOutput;
use App\Jobs\TurnUpdate\Planet\LocalBuildingQueue;
use App\Jobs\TurnUpdate\Planet\LocalConversionQueue;
use App\Jobs\TurnUpdate\Planet\LocalInterest;
use App\Jobs\TurnUpdate\Planet\LocalOutput;
use App\Jobs\TurnUpdate\Planet\LocalResourceCache;
use App\Jobs\TurnUpdate\Planet\LocalTaxes;
use App\Jobs\TurnUpdate\Planet\LocalUnitQueue;
use App\Jobs\TurnUpdate\PlanetsUpdate;
use App\Jobs\TurnUpdate\ResearchQueues;
use App\Jobs\TurnUpdate\StartUpdate;
use App\Models\Fleet;
use App\Models\Planet;
use Illuminate\Bus\Batch;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;

class TurnUpdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the middleware the job should pass through.
     *
     * @return array
     */
    public function middleware()
    {
        return [new WithoutOverlapping(self::class)];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        StartUpdate::dispatchSync();
        ResearchQueues::dispatchSync();

        $planetsUpdateBatch = Bus::batch([]);
        Planet::query()->chunk(200, function ($planets) use ($planetsUpdateBatch) {
            foreach ($planets as $planet) {
                $planetsUpdateBatch->jobs->add([
                    new LocalBuildingQueue($planet),
                    new LocalUnitQueue($planet),
                    new LocalConversionQueue($planet),
                    new LocalResourceCache($planet),
                    new LocalInterest($planet),
                    new LocalOutput($planet),
                    new LocalTaxes($planet),
                ]);
            }
        });

        $planetsUpdateBatch
            ->name('planets')
            ->allowFailures()
            ->finally(function (Batch $batch) {
                GlobalInterest::dispatchSync();
                GlobalOutput::dispatchSync();

                $fleetsUpdateBatch = Bus::batch([]);

                Fleet::query()->chunk(200, function ($fleets) use ($fleetsUpdateBatch) {
                    foreach ($fleets as $fleet) {
                        $fleetsUpdateBatch->jobs->add([
                            new FleetQueue($fleet),
                        ]);
                    }
                });

                if ($fleetsUpdateBatch->jobs->count()) {
                    $fleetsUpdateBatch
                        ->name('fleets')
                        ->allowFailures()
                        ->finally(function (Batch $batch) {
                            EndUpdate::dispatchSync();
                        })
                        ->dispatch();
                } else {
                    EndUpdate::dispatchSync();
                }

            })
            ->dispatch();
    }
}

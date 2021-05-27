<?php

namespace App\Jobs\TurnUpdate;

use App\Jobs\TurnUpdate\Fleet\FleetQueue;
use App\Models\Fleet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;

class FleetsUpdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $fleetsUpdateBatch = Bus::batch([]);
        Fleet::query()->chunk(200, function ($fleets) use ($fleetsUpdateBatch) {
            foreach ($fleets as $fleet) {
                $fleetsUpdateBatch->jobs->add([
                    new FleetQueue($fleet),
                ]);
            }
        });
        $fleetsUpdateBatch->name('fleets');
        $fleetsUpdateBatch->dispatch();
    }
}

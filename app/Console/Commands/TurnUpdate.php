<?php

namespace App\Console\Commands;

use App\Models\Planet;
use App\Models\Ruler;
use Illuminate\Console\Command;

class TurnUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ic:mtu';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manual turn update';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $ruler = Ruler::find(1);
        if (!$ruler->planets()->exists()) {
            $home_planet = Planet::homePlanets()->unpopulated()->first();
            $home_planet->ruler_id = 1;
            $home_planet->save();
            $home_planet->populateStartingBuildings();
        }

        \App\Jobs\TurnUpdate::dispatch();
        return 0;
    }
}

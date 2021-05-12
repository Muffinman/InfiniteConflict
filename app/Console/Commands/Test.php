<?php

namespace App\Console\Commands;

use App\Jobs\TurnUpdate\Planet\ResourceCache;
use App\Models\Ruler;
use App\Jobs\TurnUpdate\Planet\LocalInterest;
use App\Jobs\TurnUpdate\Planet\LocalOutput;
use App\Jobs\TurnUpdate\Planet\LocalTaxes;
use App\Models\Planet;
use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

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
        $users = Ruler::factory()->count(500)->create();
        //die;

        //$planet = Planet::find(1);
        //ResourceCache::dispatchSync($planet);
        //LocalInterest::dispatchSync($planet);
        //LocalOutput::dispatchSync($planet);
        //LocalTaxes::dispatchSync($planet);
        return 0;
    }
}

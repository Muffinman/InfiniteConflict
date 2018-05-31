<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::route(['middleware' => ['web']]);

        Broadcast::auth('channel-name.*', function ($user, $id) {
            return true;
        });
    }
}

<?php

namespace App\Providers;

use App\Session\MongoSessionHandler;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class SessionServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(ConnectionInterface $connection)
    {
        Session::extend('database', function ($app) use ($connection) {
            $table = config('session.table');
            $minutes = config('session.lifetime');

            return new MongoSessionHandler($connection, $table, $minutes);
        });
    }
}

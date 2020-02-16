<?php

namespace App\Providers;

use App\Services\PengajuanService;
use Illuminate\Support\ServiceProvider;

class PengajuanServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }
  
    public function register()
    {
        $this->app->bind('App\Services\PengajuanService', function ($app) {
            return new PengajuanService();
        });
    }
}

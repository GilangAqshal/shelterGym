<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\IlluminateRequest; // Tambah ini jika diperlukan, atau langsung pakai request()

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Jika aplikasi berjalan di production (Railway)
        if (config('app.env') === 'production') {
            // 1. Paksa semua URL dan Form Action generate jalur HTTPS
            URL::forceScheme('https');

            // 2. Paksa Laravel memercayai balancer/proxy dari Railway
            request()->setTrustedProxies(
                ['0.0.0.0/0', '2a00::/12'], // Memercayai semua rentang IP Proxy cloud
                \Illuminate\Http\Request::HEADER_X_FORWARDED_FOR |
                \Illuminate\Http\Request::HEADER_X_FORWARDED_HOST |
                \Illuminate\Http\Request::HEADER_X_FORWARDED_PORT |
                \Illuminate\Http\Request::HEADER_X_FORWARDED_PROTO
            );
        }
    }
}
<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use App\Models\CryptoPrice;

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
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }
        View::composer('*', function ($view) {
            $cryptoPrices = CryptoPrice::all()->keyBy('crypto_symbol'); // Recupera os preços de todas as criptos
            $view->with('cryptoPrices', $cryptoPrices); // Compartilha com todas as views
        });

    }
}

<?php

namespace App\Providers;

use App\Models\Entreprise;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        View::composer(['layouts.app', 'layouts.admin', 'home', 'about'], function ($view) {
            try {
                $entreprise = Entreprise::first();
            } catch (\Throwable $e) {
                $entreprise = null;
            }

            $view->with('entreprise', $entreprise);
        });
    }
}
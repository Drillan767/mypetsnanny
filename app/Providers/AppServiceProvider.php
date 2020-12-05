<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerInertia();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    private function registerInertia ()
    {
        Inertia::share([
            'flash' => function () {
                return [
                    'message' => Session::get('message'),
                    'success' => Session::get('success'),
                    'error' => Session::get('error'),
                ];
            }
        ]);
    }
}

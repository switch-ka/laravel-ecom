<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Costume;
use Illuminate\Support\Facades\View;
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
    public function boot()
{
    \Illuminate\Support\Facades\Artisan::call('migrate', ["--force" => true]);
    try {
        View::share('costumes', Costume::all());
    } catch (\Exception $e) {
        // Prevent crash during deployment
        View::share('costumes', []);
    }
}

    

}

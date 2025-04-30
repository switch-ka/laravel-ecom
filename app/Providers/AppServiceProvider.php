<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Costume;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Artisan;

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
    try {
        Artisan::call('migrate', ['--force' => true]);
    } catch (\Exception $e) {
        \Log::error('Migration failed: ' . $e->getMessage());
    }
    try {
        View::share('costumes', Costume::all());
    } catch (\Exception $e) {
        // Prevent crash during deployment
        View::share('costumes', []);
    }
}

    

}

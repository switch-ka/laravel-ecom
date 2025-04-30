<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Costume;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        DB::connection()->getPdo();
        Log::info('✅ Database connection successful.');

        Artisan::call('migrate', ['--force' => true]);
        Log::info('✅ Migration executed.');
    } catch (\Exception $e) {
        Log::error('❌ Migration or DB connection failed: ' . $e->getMessage());
    }
    try {
        View::share('costumes', Costume::all());
    } catch (\Exception $e) {
        // Prevent crash during deployment
        View::share('costumes', []);
    }
}

    

}

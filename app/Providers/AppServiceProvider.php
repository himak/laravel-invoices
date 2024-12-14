<?php

namespace App\Providers;

use App\Policies\CustomerPolicy;
use App\Policies\InvoicePolicy;
use App\Policies\ItemPolicy;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrapFour();

        Gate::define('update', [CustomerPolicy::class, 'update']);
        Gate::define('update', [ItemPolicy::class, 'update']);
        Gate::define('update', [InvoicePolicy::class, 'update']);
    }
}

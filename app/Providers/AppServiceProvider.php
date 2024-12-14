<?php

namespace App\Providers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Item;
use App\Observers\CustomerObserver;
use App\Observers\InvoiceObserver;
use App\Observers\ItemObserver;
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

        Item::observe(ItemObserver::class);
        Customer::observe(CustomerObserver::class);
        Invoice::observe(InvoiceObserver::class);

        Gate::define('update', [CustomerPolicy::class, 'update']);
        Gate::define('update', [ItemPolicy::class, 'update']);
        Gate::define('update', [InvoicePolicy::class, 'update']);
    }
}

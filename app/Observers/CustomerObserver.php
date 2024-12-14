<?php

namespace App\Observers;

use App\Models\Customer;

class CustomerObserver
{
    public function creating(Customer $customer): void
    {
        if (auth()->check()) {
            $customer->user_id = auth()->id();
        }
    }

    /**
     * Handle the Customer "created" event.
     *
     * @return void
     */
    public function created(Customer $customer)
    {
        //
    }

    /**
     * Handle the Customer "updated" event.
     *
     * @return void
     */
    public function updated(Customer $customer)
    {
        //
    }

    /**
     * Handle the Customer "deleted" event.
     *
     * @return void
     */
    public function deleted(Customer $customer)
    {
        //
    }

    /**
     * Handle the Customer "restored" event.
     *
     * @return void
     */
    public function restored(Customer $customer)
    {
        //
    }

    /**
     * Handle the Customer "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Customer $customer)
    {
        //
    }
}

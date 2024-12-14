<?php

namespace App\Observers;

use App\Models\Item;

class ItemObserver
{
    public function creating(Item $item): void
    {
        if (auth()->check()) {
            $item->user_id = auth()->id();
        }
    }

    /**
     * Handle the Item "created" event.
     *
     * @return void
     */
    public function created(Item $item)
    {
        //
    }

    /**
     * Handle the Item "updated" event.
     *
     * @return void
     */
    public function updated(Item $item)
    {
        $item->user_id = auth()->id();
    }

    /**
     * Handle the Item "deleted" event.
     *
     * @return void
     */
    public function deleted(Item $item)
    {
        //
    }

    /**
     * Handle the Item "restored" event.
     *
     * @return void
     */
    public function restored(Item $item)
    {
        //
    }

    /**
     * Handle the Item "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Item $item)
    {
        //
    }
}

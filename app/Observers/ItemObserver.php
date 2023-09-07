<?php

namespace App\Observers;

use App\Models\Item;

class ItemObserver
{
    public function creating(Item $item)
    {
        if (auth()->check()) {
            $item->user_id = auth()->id();
        }
    }

    /**
     * Handle the Item "created" event.
     *
     * @param  \App\Models\Item  $item
     * @return void
     */
    public function created(Item $item)
    {
        //
    }

    /**
     * Handle the Item "updated" event.
     *
     * @param  \App\Models\Item  $item
     * @return void
     */
    public function updated(Item $item)
    {
        $item->user_id = auth()->id();
    }

    /**
     * Handle the Item "deleted" event.
     *
     * @param  \App\Models\Item  $item
     * @return void
     */
    public function deleted(Item $item)
    {
        //
    }

    /**
     * Handle the Item "restored" event.
     *
     * @param  \App\Models\Item  $item
     * @return void
     */
    public function restored(Item $item)
    {
        //
    }

    /**
     * Handle the Item "force deleted" event.
     *
     * @param  \App\Models\Item  $item
     * @return void
     */
    public function forceDeleted(Item $item)
    {
        //
    }
}

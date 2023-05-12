<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('item.index')
            ->with('items', \Auth::user()->items()
                ->get(['id', 'user_id','name', 'price'])
                ->sortBy('name')
            );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('item.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        auth()->user()->items()->create($request->validated());

        session()->flash('success', __('Item was success saved.'));

        return redirect(route('items.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        $this->authorize('update', $item);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $this->authorize('update', $item);

        return view('item.edit')
            ->with(compact($item));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $this->authorize('update', $item);

        $item = Item::updateOrCreate(
            ['id' => $request->item_id],
            $request->validated()
        );

        session()->flash('success', __('Item was updated.'));

        return view('item.edit')
            ->with(compact($item));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $this->authorize('update', $item);

        try {
            \Auth::user()->items()->findOrFail($item->id)->delete();
        } catch (\Exception $e) {
            session()->flash('danger', __('Item was not deleted!'));
            return redirect(route('items.index'));
        }

        session()->flash('danger', __('Item was deleted!'));

        return redirect(route('items.index'));
    }
}

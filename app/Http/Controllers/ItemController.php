<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Gate;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        /** @var User $user */
        $user = auth()->user();

        $items = $user->items()
            ->paginate(10);

        return view('item.index', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request): Redirector|Application|RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();

        $user->items()->create($request->validated());

        return redirect(route('items.index'))
            ->with('success', __('Item was created successfully.'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('item.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item): RedirectResponse
    {
        abort_if(Gate::denies('update', $item), 403);

        return redirect()->route('items.edit', $item);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item): View
    {
        abort_if(Gate::denies('update', $item), 403);

        return view('item.edit')
            ->with('item', $item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @throws AuthorizationException
     */
    public function update(UpdateItemRequest $request, Item $item): View
    {
        abort_if(Gate::denies('update', $item), 403);

        $item->update($request->validated());

        return view('item.edit')
            ->with([
                'item' => $item,
                'success' => __('Item was updated successfully.'),
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @throws AuthorizationException
     */
    public function destroy(Item $item): Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('update', $item), 403);

        $item->delete();

        return redirect()->route('items.index')
            ->with('danger', __('Item was deleted successfully.'));
    }
}

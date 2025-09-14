<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ItemController extends Controller
{
    /**
     * Number of items per page
     */
    private const ITEMS_PER_PAGE = 10;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        /** @var User $user */
        $user = auth()->user();

        return view('item.index', [
            'items' => $user->items()->paginate(self::ITEMS_PER_PAGE),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = auth()->guard()->user();

        $user->items()->create($request->validated());

        return redirect()
            ->route('items.index')
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
        $this->authorize('update', $item);

        return redirect()->route('items.edit', $item);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item): View
    {
        $this->authorize('update', $item);

        return view('item.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @throws AuthorizationException
     */
    public function update(UpdateItemRequest $request, Item $item): View
    {
        $this->authorize('update', $item);

        $item->update($request->validated());

        return view('item.edit', [
            'item' => $item,
            'success' => __('Item was updated successfully.'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @throws AuthorizationException
     */
    public function destroy(Item $item): RedirectResponse
    {
        $this->authorize('update', $item);

        $item->delete();

        return redirect()
            ->route('items.index')
            ->with('danger', __('Item was deleted successfully.'));
    }
}

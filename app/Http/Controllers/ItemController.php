<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Factory|View|Application
    {
        /** @var User $user */
        $user = auth()->user();

        $items = $user->items()
            ->paginate(10);

        return view('item.index')
            ->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Factory|View|Application
    {
        return view('item.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request): Redirector|Application|RedirectResponse
    {
        auth()->user()->items()->create($request->validated());

        session()->flash('success', __('Item was success saved.'));

        return redirect(route('items.index'));
    }

    /**
     * Display the specified resource.
     *
     * @throws AuthorizationException
*/
    public function show(Item $item): Factory|View|Application
    {
        $this->authorize('update', $item);

        return view('item.edit')
            ->with(compact($item));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @throws AuthorizationException
     */
    public function edit(Item $item): Factory|View|Application
    {
        $this->authorize('update', $item);

        return view('item.edit')
            ->with('item', $item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @throws AuthorizationException
     */
    public function update(UpdateItemRequest $request, Item $item): Factory|View|Application
    {
        $this->authorize('update', $item);

        $item = Item::query()->updateOrCreate(
            ['id' => $request->item_id],
            $request->validated()
        );

        session()->flash('success', __('Item was updated.'));

        return view('item.edit')
            ->with('item', $item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @throws AuthorizationException
     */
    public function destroy(Item $item): Redirector|Application|RedirectResponse
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

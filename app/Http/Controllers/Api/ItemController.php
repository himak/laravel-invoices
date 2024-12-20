<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use App\Models\User;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        /* @var User $user */
        $user = Auth::user();

        return ItemResource::collection($user->getAttribute('items'));
        //        return ItemResource::collection(request()->user()->items);
        //        return ItemResource::collection(Item::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request): ItemResource
    {
        /* @var User $user */
        $user = Auth::user();

        $item = $user->items()->create($request->validated());

        return ItemResource::make($item);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item): ItemResource
    {
        abort_if(Gate::denies('update', $item), 403);

        return ItemResource::make($item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreItemRequest $request, Item $item): JsonResponse
    {
        abort_if(Gate::denies('update', $item), 403);

        $item->update($request->validated());

        return response()->json(ItemResource::make($item), Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item): Response
    {
        abort_if(Gate::denies('update', $item), 403);

        $item->delete();

        return response()->noContent();
    }
}

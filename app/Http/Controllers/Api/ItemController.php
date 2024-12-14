<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return ItemResource::collection(Item::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request): ItemResource
    {
        $item = Item::query()->create($request->validated());

        return ItemResource::make($item);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item): ItemResource
    {
        return ItemResource::make($item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreItemRequest $request, Item $item): JsonResponse
    {
        $item->update($request->validated());

        return response()->json(ItemResource::make($item), Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item): Response
    {
        $item->delete();

        return response()->noContent();
    }
}

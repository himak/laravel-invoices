<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'company']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('item.index')->with('items', Item::all('id', 'name', 'price')->sortBy('name'));
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:items,name',
            'price' => 'required'
        ]);

        $item = new Item();

        $request->price = str_replace(',', '.', $request->price);

        $item->name = $request->name;
        $item->price = $request->price;

        $item->save();

        session()->flash('success', 'Item was success saved.');

        return redirect('/items');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return view('item.edit')->with('item', $item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'item_id' => 'required|integer|exists:items,id',
            'name' => 'required',
            'price' => 'required|numeric'
        ]);

        $item = Item::findOrFail($request->item_id);

        $request->price = str_replace(',', '.', $request->price);

        $item->name = $request->name;
        $item->price = $request->price;

        $item->save();

        session()->flash('success', 'Item was updated.');

        return view('item.edit')->with('item', $item);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        Item::destroy($item->id);

        session()->flash('danger', 'Item was deleted!');

        return redirect('/items');
    }
}

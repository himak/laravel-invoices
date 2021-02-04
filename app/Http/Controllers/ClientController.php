<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
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
        return view('client.index')
            ->with('clients', Client::all(['id','business_name', 'identification_code'])
            ->sortBy('business_name'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'business_name' => 'required|min:3|unique:clients,business_name',
            'identification_code' => 'nullable|min:8|unique:clients,identification_code',
        ]);

        $client = new Client();

        $client->business_name = $request->business_name;
        $client->identification_code = $request->identification_code;

        $client->save();

        session()->flash('success', 'Customer saved successfully.');

        return redirect('/clients');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('client.edit')->with('client', $client);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'client_id' => 'required|integer|exists:clients,id',
            'business_name' => 'required|min:3',
            'identification_code' => 'nullable',
        ]);

        $client = Client::findOrFail($request->client_id);

        $client->business_name = $request->business_name;
        $client->identification_code = $request->identification_code;

        $client->save();

        session()->flash('success', 'Customer details changed successfully.');

        return view('client.edit')->with('client', $client);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        Client::destroy($client->id);

        session()->flash('danger', 'Customer has been deleted!');

        return redirect('/clients');
    }
}

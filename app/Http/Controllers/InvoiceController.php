<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Item;
use Auth;
use Illuminate\Http\Request;

class InvoiceController extends Controller
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
        return view('invoice.index')
                ->with('invoices', \Auth::user()->invoices()->with('customer')
                ->orderBy('invoice_number')->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = \Auth::user()->customers()->get(['id', 'business_name'])->sortBy('business_name');
        $items = \Auth::user()->items()->get(['id', 'name', 'price'])->sortBy('name');

        if (!count($customers)) {
            session()->flash('info', 'First should add the customer.');
            return redirect('/customers/create');
        }

        if (!count($items)) {
            session()->flash('info', 'First should add some item.');
            return redirect('/items/create');
        }

        return view('invoice.create')->with([
            'customers' => $customers,
            'items' => $items
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        // Validate data for invoice
        $request->validated();

        // Get total price for invoice from items
        $total_price = 0;

        foreach($request->items as $item) {
            $total_price += Item::whereKey($item)->first()->getAttributeValue('price');
        }

        // Create invoice
        $invoice = new Invoice();

        $invoice->user_id = auth()->id();
        $invoice->customer_id = $request->customer_id;
        $invoice->invoice_number = $request->invoice_number;
        $invoice->due_date = $request->due_date;
        $invoice->total_price = $total_price;

        $invoice->save();

        foreach($request->items as $key => $item){

            $item_data = Item::whereKey($item)->first()->only(['id','name','price']);

            $invoice_items = InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'item_id' => $item_data['id'],
                'name' => $item_data['name'],
                'price' => $item_data['price'],
            ]);

        }

        session()->flash('success', 'Invoice was success added.');

        return redirect('/invoices');
    }



    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $this->authorize('update', $invoice);

        return view('invoice.show')->with([
            'invoice' => Invoice::whereKey($invoice)->with(['customer', 'invoiceItems'])->first()
        ]);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $this->authorize('update', $invoice);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $this->authorize('update', $invoice);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $this->authorize('update', $invoice);

        Invoice::destroy($invoice->id);

        Auth::user()->invoices()->findOrFail($invoice->id)->delete();

        session()->flash('danger', 'Invoice was deleted!');

        return redirect('/invoices');
    }



    /**
     * Display the specified resource.
     */
    public function print(Invoice $invoice)
    {
        $this->authorize('update', $invoice);
    }
}

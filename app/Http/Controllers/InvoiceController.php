<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Item;
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
                    ->with('invoices', Invoice::with('customer')->orderBy('invoice_number')->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $items = Item::all();

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
        $invoice = Invoice::create([
            'customer_id' => $request->customer_id,
            'invoice_number' => $request->invoice_number,
            'due_date' => $request->due_date,
            'total_price' => $total_price
        ]);

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
        return view('invoice.show')->with([
            'invoice' => Invoice::whereKey($invoice)->with(['customer', 'invoiceItems'])->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        return view('invoice.edit')
            ->with([
                'invoice' => $invoice,
                'customers' => Customer::all(),
                'items' => Item::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        Invoice::destroy($invoice->id);

        session()->flash('danger', 'Invoice was deleted!');

        return redirect('/invoices');
    }



    /**
     * Display the specified resource.
     */
    public function print(Invoice $invoice)
    {
        return view('invoice.print')->with([
            'invoice' => Invoice::whereKey($invoice)->with(['customer', 'invoiceItems'])->first()
        ]);
    }
}

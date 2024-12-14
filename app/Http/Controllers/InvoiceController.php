<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();

        $invoices = $user->invoices()
            ->with('customer')
            ->orderBy('invoice_number')
            ->get();

        return view('invoice.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /** @var User $user */
        $user = auth()->user();

        $customers = $user->customers()
            ->orderBy('business_name')
            ->pluck('business_name', 'id');

        $items = $user->items()
            ->orderBy('name')
            ->get(['id', 'name', 'price']);

        if (! count($customers)) {
            return redirect()->route('customers.create')
                ->with('info', __('First should add the customer.'));
        }

        if (! count($items)) {
            return redirect()->route('items.create')
                ->with('info', __('First should add some item.'));
        }

        if ((int) $user->invoices()->max('invoice_number') === 0) {
            $invoice_number = (int) (now()->year.Str::padLeft(1, 4, '0'));
        } else {
            $invoice_number = (int) $user->invoices()->max('invoice_number') + 1;
        }

        return view('invoice.create')->with([
            'customers' => $customers,
            'items' => $items,
            'invoice_number' => $invoice_number,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request): RedirectResponse
    {
        // Get total price for invoice from items
        $total_price = 0;

        foreach ($request->get('items') as $item) {
            $total_price += Item::query()
                ->whereKey($item)
                ->first()?->getAttributeValue('price');
        }

        /** @var User $user */
        $user = auth()->user();

        $invoice = $user->invoices()->create([
            'customer_id' => $request->get('customer_id'),
            'invoice_number' => $request->get('invoice_number'),
            'due_date' => $request->get('due_date'),
            'total_price' => $total_price,
        ]);

        foreach ($request->get('items') as $item) {

            $item_data = Item::query()
                ->whereKey($item)
                ->first()
                ?->only(['id', 'name', 'price']);

            InvoiceItem::query()->create([
                'invoice_id' => $invoice->getAttribute('id'),
                'item_id' => $item_data['id'],
                'name' => $item_data['name'],
                'price' => $item_data['price'],
            ]);

        }

        return redirect()->route('invoices.index')
            ->with('success', __('Invoice was success added.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        abort_if(Gate::denies('update', $invoice), 403);

        return view('invoice.show')->with([
            'invoice' => $invoice,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice): RedirectResponse
    {
        abort_if(Gate::denies('update', $invoice), 403);

        $invoice->delete();

        return redirect()->route('invoices.index')
            ->with('danger', __('Invoice was deleted!'));
    }
}

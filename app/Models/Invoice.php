<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'invoice_number',
        'due_date',
        'total_price',
    ];


    /**
     * Get the customer for an invoice.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


    /**
     * Get the customer for an invoice.
     */
    public function items()
    {
        return $this->belongsToMany(Item::class);
    }


    /**
     * Get the user associated with an invoice.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Get the customer for the invoice.
     */
    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }


    /**
     * Check if invoice has item
     * @param $invoiceItemId
     * @return bool
     */
    public function hasInvoiceItems($invoiceItemId)
    {
        return in_array($invoiceItemId, $this->invoiceItems->pluck('item_id')->toArray());
    }


    /**
     * Get the invoice's total price.
     * @param $value
     * @return string
     */
    public function getTotalPriceAttribute($value)
    {
        return number_format($value, 2, '.', '');
    }


    public function totalPrice($items) {
        $totalPrice = 0;

        foreach ($items as $item) {
            $totalPrice += $item->price;
        }

        return $totalPrice;
    }
}

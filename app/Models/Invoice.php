<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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
     * Get the invoice's due date.
     */
    public function getDueDateAttribute($value): string
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d.m.Y');
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

    protected static function booted()
    {
        static::addGlobalScope('user', function (Builder $builder) {
            $builder->where('user_id', auth()->id());
        });
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

    public function totalPrice($items) {
        $totalPrice = 0;

        foreach ($items as $item) {
            $totalPrice += $item->price;
        }

        return $totalPrice;
    }
}

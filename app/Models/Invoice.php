<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the user associated with an invoice.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the customer for the invoice.
     */
    public function invoiceItems(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    /**
     * Get the invoice's due date.
     */
    protected function dueDate(): Attribute
    {
        return Attribute::make(
            get: static fn (string $value) => Carbon::createFromFormat('Y-m-d', $value)?->format('d.m.Y'),
        );
    }

    /**
     * Get the invoice's total price.
     */
    protected function totalPrice(): Attribute
    {
        return Attribute::make(
            get: static fn (string $value) => number_format($value, 2, '.', ''),
        );
    }
}

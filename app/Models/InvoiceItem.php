<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id',
        'item_id',
        'name',
        'price',
    ];

    /**
     * Get the items for an invoice.
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    /**
     * Get the item's price.
     * @param $value
     * @return string
     */
    public function getPriceAttribute($value)
    {
        return number_format($value, 2, '.', '');
    }
}

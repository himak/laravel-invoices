<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'price',
    ];

    /**
     * Get the user associated with an item.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the item's price.
     */
    protected function price(): Attribute
    {
        return Attribute::make(
            get: static fn (string $value) => number_format($value, 2, '.', ''),
            set: static fn (string $value) => number_format($value, 2, '.', ''),
        );
    }
}

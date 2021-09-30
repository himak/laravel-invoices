<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
    ];


    /**
     * Get the user associated with an item.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
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

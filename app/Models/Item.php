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
     * @param string $value
     * @return string
     */
    public function getPriceAttribute($value)
    {
        return number_format($value, 2, '.', '');
    }


    /**
     * Set the item's price.
     *
     * @param  string  $value
     * @return string
     */
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = number_format($value, 2, '.', '');
    }


    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($item) {
            $item->user_id = auth()->id();
        });
    }
}

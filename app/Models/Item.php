<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

//    protected static function booted()
//    {
//        static::addGlobalScope('user', function (Builder $builder) {
//            $builder->where('user_id', auth()->id());
//        });
//    }
}

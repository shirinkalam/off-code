<?php

namespace App\Models;

use App\Support\Discount\DiscountCalculatr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function hasStock(int $quantity)
    {
        return $this->stock >= $quantity;
    }

    public function decerementStock(int $count)
    {
        return $this->decrement('stok',$count);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getPriceAttribute($price)
    {
        $coupons = $this->category->validCoupons();
        if($coupons->isNotEmpty()){
            $discountCalculator = resolve(DiscountCalculatr::class);
            return $discountCalculator->discountedPrice($coupons->first() , $price);
        }

        return $price ;
    }
}

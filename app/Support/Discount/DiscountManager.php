<?php

namespace App\Support\Discount;

use App\Support\Cost\BasketCost;

class DiscountManager
{

    private $basketCost ;
    private $discountCalculatr ;

    public function __construct(BasketCost $basketCost , DiscountCalculatr $discountCalculatr)
    {
        $this->basketCost = $basketCost ;
        $this->discountCalculatr = $discountCalculatr;
    }

    public function calculateUserDiscount()
    {
        if(!session()->has('coupon')) return 0 ;

        return $this->discountCalculatr->discountAmount(session()->get('coupon') , $this->basketCost->getTotalCost());
    }
}

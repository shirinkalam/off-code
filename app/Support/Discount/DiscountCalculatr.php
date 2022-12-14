<?php

namespace App\Support\Discount;

use App\Models\Coupon;

class DiscountCalculatr
{
    public function discountAmount(Coupon $coupon , int $amount)
    {
        $discountAmount =(int) (($coupon->percent  / 100) * $amount);

        return $this->isExeeded($discountAmount , $coupon->limit) ? $coupon->limit : $discountAmount;
    }

    private function isExeeded(int $amount,int $limit)
    {
        return $amount > $limit;
    }

    public function discountedPrice(Coupon $coupon , int $amount)
    {
        return $amount - $this->discountAmount($coupon, $amount);
    }
}

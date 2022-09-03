<?php

namespace App\Support\Discount\Coupon\Validator;

use App\Exceptions\IllegalCouponException;
use App\Models\Coupon;
use App\Support\Discount\Coupon\Validator\Contracts\AbstractCouponValidator;

class CanUseIt extends AbstractCouponValidator
{
    public function validate(Coupon $coupon)
    {
        if(!auth()->user()->coupons->countains($coupon)){
            throw new IllegalCouponException();
        }

        return parent::validate($coupon);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Support\Discount\Coupon\CouponValidator;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    private $validator;

    public function __construct(CouponValidator $validator)
    {
        $this->middleware('auth');
        $this->validator = $validator;
    }

    public function store(Request $request)
    {
        #validate coupon
        try{
            $request->validate([
                'coupon'=>['required','exists:coupons,code'],
            ]);

            #can user use it
            $coupon = Coupon::where('code',$request->coupon)->firstOrFail();

            #put coupon into session
            session()->put(['coupon'=>$coupon]);

            #redirect
            return redirect()->back()->withSuccess('کد تخفیف با موفقیت اعمال شد');
        }catch(\Exception $e){
            return redirect()->back()->withError('کد تخفیف نا معتبر میباشد');
        }

    }

    public function remove()
    {
        session()->forget('coupon');

        return back();
    }
}

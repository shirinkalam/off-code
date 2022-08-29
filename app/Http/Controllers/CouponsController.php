<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
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
}

<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\AdminCoupon;
use App\Models\PhoneUserToCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller {

    public function receive()
    {
        return view('home.coupon.receive');
    }

    public function postReceive()
    {
        $code = Input::get('code');
        if ($code) {
            $coupon = AdminCoupon::where(['coupon_code' => $code])->first();
            if ($coupon) {
                $data = [];
                $data['coupon_id'] = $coupon->id;
                $data['user_id'] = Session::get('uid');
                $data['is_used'] = 0;
                $isCoupon = PhoneUserToCoupon::where($data)->first();
                if ($isCoupon) {
                    flash('亲,您已经领取过这个红包啦~');
                    return redirect()->back();
                }
                $couponToUser = new PhoneUserToCoupon();
                $couponToUser->coupon_id = $coupon->id;
                $couponToUser->user_id = Session::get('uid');
                if ($couponToUser->save()) {
                    $coupon->used += 1;
                    $coupon->save();
                    return redirect("coupon/success/$coupon->coupon_price");
                } else {
                    flash('亲~现在服务器压力山大~请稍后再试');
                    return redirect()->back();
                }
            } else {
                flash('亲~兑换码不对呦~请重试');
                return redirect()->back();
            }
        } else {
            flash('亲~兑换码不能为空哦~请重试');
            return redirect()->back();
        }
    }

    public function success($price)
    {
        if ($price and is_numeric($price)) {
            $data = [];
            $data['price'] = $price;
            return view('home.coupon.success')->with($data);
        } else {
            return redirect()->back();
        }
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}

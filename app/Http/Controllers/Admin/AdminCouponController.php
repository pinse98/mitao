<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\AdminCoupon;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class AdminCouponController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('admin.coupon.show')->withCoupons(AdminCoupon::orderBy('id', 'DESC')->paginate(10));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.coupon.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$name = Input::get('name');
        $price = Input::get('price');
        if ($name and $price) {
            $coupon = new AdminCoupon();
            $coupon->coupon_name = $name;
            $coupon->coupon_code = rand(100000, 999999);
            $coupon->coupon_price = $price;
            if ($coupon->save()) {
                return redirect('admin/coupon/show');
            }
        }
        return redirect()->back();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        if ($id) {
            return view('admin.coupon.modify')->withCoupon(AdminCoupon::find($id));
        }
        return redirect()->back();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if ($id) {
            $coupon = AdminCoupon::find($id);
            if ($coupon) {
                $name = Input::get('name');
                $price = Input::get('price');
                if ($name and $price) {
                    $coupon->coupon_name = $name;
                    $coupon->coupon_price = $price;
                    if ($coupon->save()) {
                        return redirect('admin/coupon/show');
                    }
                }
            }
        }
        return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if ($id) {
            $coupon = AdminCoupon::find($id);
            if ($coupon) {
                $user = AdminUser::where(['coupon_id' => $coupon->id])->first();
                if ($user) {
                    $user->coupon_id = 0;
                    $user->save();
                }
                $coupon->delete();
            }
        }
        return redirect()->back();
	}

}

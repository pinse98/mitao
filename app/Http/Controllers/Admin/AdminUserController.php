<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\AdminUser;
use App\Models\PhoneOrder;
use App\Models\PhoneUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class AdminUserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $admin_level = Session::get('admin_id');
		return view('admin.users.show')->withUsers(AdminUser::whereRaw("level <> $admin_level")->paginate(10));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$username = Input::get('username', null);
        $password = Input::get('password', null);
        if ($username and $password) {
            if (!AdminUser::where(['username' => $username])->first()) {
                $user = new AdminUser();
                $user->username = $username;
                $user->password = sha1($password);
                $user->coupon_id = Input::get('coupon', 0);
                if ($user->save()) {
                    return redirect('admin/users/show');
                }
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
            return view('admin.users.modify')->withUser(AdminUser::find($id));
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
            $user = AdminUser::find($id);
            if($user) {
                $password = Input::get('password', null);
                if ($password) {
                    $user->password = sha1($password);
                }
                $user->coupon_id = Input::get('coupon', 0);
                if ($user->save()) {
                    return redirect('admin/users/show');
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
            $user = AdminUser::find($id);
            if ($user) {
                if ($user->enable) {
                    $user->enable = 0;
                } else {
                    $user->enable = 1;
                }
                $user->save();
            }
        }
        return redirect()->back();
	}

    /**
     * 支付佣金
     *
     * @param int $uid
     * @return \Illuminate\Http\RedirectResponse
     */
    public function payCommission($uid = 0)
    {
        $user = AdminUser::find($uid);
        if ($user) {
            if ($user->coupon) {
                $orders = PhoneOrder::where(['coupon_id' => $user->coupon->id, 'coupon_pay' => 0])->get();
                if (count($orders)) {
                    foreach ($orders as $order) {
                        $order->coupon_pay = 1;
                        $order->save();
                    }
                }
            }
        }
        return redirect()->back();
    }

    /**
     * 用户管理
     *
     * @return mixed
     */
    public function memberShow()
    {
        return view('admin.users.member')->withMembers(PhoneUser::orderBy('id', 'DESC')->paginate(10));
    }


    /**
     * 商家首页
     *
     * @return $this
     */
    public function promote()
    {
        $data = [];
        $data['price'] = 0;
        $user = AdminUser::find(Session::get('admin_id'));
        if ($user->coupon) {
            $data['code'] = $user->coupon->coupon_code;
            $data['orders'] = PhoneOrder::where(['coupon_id' => $user->coupon->id, 'coupon_pay' => 0])->get();
        } else {
            $data['code'] = null;
            $data['orders'] = null;
        }

        if ($data['orders']) {
            foreach($data['orders'] as $order) {
                if ($order->pay_type == 1) {
                    $data['price'] += 100;
                }
            }
        }
        return view('admin.promote.show')->with($data);
    }

}

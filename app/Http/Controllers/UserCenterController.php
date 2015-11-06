<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\PhoneOrder;
use App\Models\PhoneUserToCoupon;
use App\Services\PHPCurl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserCenterController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('home.my.ucenter');
	}

    public function coupon()
    {
        return view('home.my.coupon')->withCoupons(PhoneUserToCoupon::where(['user_id' => Session::get('uid'), 'is_used' => 0])->get());
    }

    public function orderSuccess()
    {
        $uid = Session::get('uid');
        $orderSuccess = PhoneOrder::where(['pay_type' => 1, 'user_id' => $uid])->orderBy('created_at', 'DESC')->get();
        if (count($orderSuccess)) {
            return view('home.my.order.success')->withOrders($orderSuccess);
        } else {
            flash('亲~您还没有已支付订单哦');
            return redirect()->back();
        }
    }

    public function orderWaitpay()
    {
        $uid = Session::get('uid');
        $orderWaitpay = PhoneOrder::where(['pay_type' => 0, 'user_id' => $uid])->orderBy('created_at', 'DESC')->get();
        if (count($orderWaitpay)) {
            return view('home.my.order.waitpay')->withOrders($orderWaitpay);
        } else {
            flash('亲~您还没有待付款订单哦');
            return redirect()->back();
        }
    }

    public function viewShipping($orderId = 0)
    {
        $data = [];
        $data['user_id'] = Session::get('uid');
        $data['id'] = $orderId;
        $data['delivery'] = 1;
        $order = PhoneOrder::where($data)->first();
        if ($order) {
            $reqData = [];
            $reqData['type'] = $order->expresses->type;
            $reqData['postid'] = $order->shipping_code;
            $expData = PHPCurl::get('http://www.kuaidi100.com/query', $reqData);
            if ($expData) {
                $res = json_decode($expData, true);
                if ($res['status'] == 200) {
                    $renData = [];
                    $renData['expresses'] = $res['data'];
                    return view('home.my.order.viewShipping')->with($renData);
                } else {
                    flash($res['message']);
                    return redirect()->back();
                }
            }
        }
        flash('亲~服务器繁忙请稍后再试');
        return redirect()->back();
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

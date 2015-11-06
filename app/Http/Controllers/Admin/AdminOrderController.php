<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\AdminExpress;
use App\Models\PhoneOrder;
use App\Services\PHPCurl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class AdminOrderController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('admin.orders.show')->withOrders(PhoneOrder::all());
	}

    /**
     * 支付订单
     *
     * @param int $orderId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function pay($orderId = 0)
    {
        $order = PhoneOrder::find($orderId);
        if ($order) {
            $order->pay_type = 1;
            $order->save();
        }
        return redirect()->back();
    }

    /**
     * 查看物流信息
     *
     * @param int $orderId
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function viewShipping($orderId = 0)
    {
        $order = PhoneOrder::find($orderId);
        if ($order and $order->delivery) {
            $data = [];
            $data['type'] = $order->expresses->type;
            $data['postid'] = $order->shipping_code;
            $response = json_decode(PHPCurl::get('http://www.kuaidi100.com/query', $data), true);
            if ($response['status'] == 200) {
                $viewData = [];
                $expr = AdminExpress::where(array('type' => $response['com']))->first();
                $viewData['name'] = $expr ? $expr->name : null;
                $viewData['code'] = $response['codenumber'];
                $viewData['datas'] = $response['data'];
                return view('admin.orders.viewShipping')->with($viewData);
            }
        }
        return redirect()->back();
    }

    /**
     * 订单发货视图
     *
     * @param int $orderId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendShipping($orderId = 0)
    {
        $order = PhoneOrder::find($orderId);
        if ($order) {
            return view('admin.orders.sendShipping')->withOrder($order);
        }
        return redirect()->back();
    }

    /**
     * 订单发货
     *
     * @param int $orderId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendOrderShipping($orderId = 0)
    {
        $order = PhoneOrder::find($orderId);
        if ($order) {
            $express = Input::get('express', 0);
            $code = Input::get('code', null);
            if ($express and $code) {
                $order->delivery = 1;
                $order->shipping_id = Input::get('express', 0);
                $order->shipping_code = Input::get('code', null);
                if ($order->save()) {
                    return redirect('admin/orders/show');
                }
            }
        }
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

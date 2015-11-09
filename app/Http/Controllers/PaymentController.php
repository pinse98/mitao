<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\PhoneOrder;
use App\Services\Alipay\AlipayCore;
use App\Services\Alipay\AlipayNotify;
use App\Services\Alipay\AlipaySubmit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PaymentController extends Controller
{
    public $config;

    public function __construct()
    {
        $this->config = config('alipay');
    }

    /**
     * 支付宝支付地址
     *
     * @return \Illuminate\Http\RedirectResponse
     */
	public function pay()
	{
        $orderId = Input::get('orderId', 0);
        if ($orderId) {
            $order = PhoneOrder::find($orderId);
            if ($order) {
                // 支付类型
                $payType = 1;
                // 服务器异步通知页面路径
                $notifyUrl = url('api/notify');
                // 页面跳转同步通知页面路径
                $returnUrl = url('order/result');
                // 商品名称
                $productName = $order->product_name . '/' .$order->sku_name;
                // 金额
                $totalFee = $order->total_fee;
                // 商品展示URL
                $productShow = url('product/details/' . $order->product_id);

                //构造要请求的参数数组
                $params = [
                    "service" => "alipay.wap.create.direct.pay.by.user",
                    "partner" => trim($this->config['partner']),
                    "seller_id" => trim($this->config['seller_id']),
                    "payment_type"	=> $payType,
                    "notify_url"	=> $notifyUrl,
                    "return_url"	=> $returnUrl,
                    "out_trade_no"	=> $orderId,
                    "subject"	=> $productName,
                    "total_fee"	=> $totalFee,
                    "show_url"	=> $productShow,
                    "_input_charset"	=> trim(strtolower($this->config['input_charset']))
                ];

                $data = [];
                //建立请求
                $submit = new AlipaySubmit($this->config);
                // $data['goPay'] = $submit->alipay_gateway_new . $submit->buildRequestParaToString($params);
                $data['$showBody'] = $submit->buildRequestForm($params, 'get', '确认支付');
                // return view('home.payment.alipaywx')->with($data);
                return view('home.payment.alipay')->with($data);
            }
        }
        return redirect()->back();
	}

    /**
     * 支付宝异步通知方法
     */
    public function notify()
    {
        $notify = new AlipayNotify($this->config);
        $verify = $notify->verifyNotify();
        if ($verify) {
            // 订单号
            $orderId = Input::get('out_trade_no', 0);

            //支付宝交易号
            $tradeId = Input::get('trade_no', 0);

            //交易状态
            $tradeStatus = Input::get('trade_status', null);

            if ($tradeStatus == 'TRADE_FINISHED' or $tradeStatus == 'TRADE_SUCCESS') {
                AlipayCore::logResult($orderId . '-' . $tradeStatus);
                $this->updateOrderPayStatus($orderId, $tradeId);
                echo 'success';
            } else {
                echo 'fail';
            }

        }
    }

    /**
     * 支付成功提示页面
     *
     * @return $this
     */
    public function returnPage()
    {
        $data = [];
        $data['success'] = false;
        $data['myOrder'] = url('my/order/waitpay');
        $notify = new AlipayNotify($this->config);
        $verify = $notify->verifyReturn();
        if ($verify) {
            $status = Input::get('trade_status', null);
            if ($status == 'TRADE_FINISHED' or $status == 'TRADE_SUCCESS') {
                $data['success'] = true;
                $data['myOrder'] = url('my/order/success');
            }
        }
        return view('home.order.pay')->with($data);
    }

    /**
     * 更新订单支付状态为成功
     *
     * @param int $orderId 订单ID
     */
    private function updateOrderPayStatus($orderId = 0, $tradeNo = null, $payStatus = 1)
    {
        if ($orderId) {
            $order = PhoneOrder::find($orderId);
            $order->pay_type = $payStatus;
            $order->trade_no = $tradeNo;
            $order->save();
        }
    }

}

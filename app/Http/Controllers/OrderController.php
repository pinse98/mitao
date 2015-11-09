<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\AdminCoupon;
use App\Models\PhoneOrder;
use App\Models\PhoneSku;
use App\Models\PhoneUser;
use App\Models\PhoneUserToCoupon;
use App\Services\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Services\CallBack;

class OrderController extends Controller {

    public function details($id)
    {
        if ($id) {
            if (VerifyUser::shipping(Session::get('uid'))) {
                $data = [];
                $data['id'] = $id;
                $data['user'] = PhoneUser::find(Session::get('uid'));
                $data['product'] = PhoneSku::find($id);
                return view('home.order.details')->with($data);
            } else {
                return redirect('my/shipping/create');
            }
        } else {
            return redirect()->back();
        }
    }

    public function postDetails($id)
    {
        $skuId = Input::get('sku_id', 0);
        $couponId = Input::get('coupon_id', 0);
        if ($id and $skuId) {
            $sku = PhoneSku::find($skuId);
            if ($sku) {
                $shipping = VerifyUser::shipping(Session::get('uid'));
                $address = [];
                if ($shipping) {
                    if ($shipping->province) {
                        array_push($address, $shipping->province);
                    }
                    if ($shipping->city) {
                        array_push($address, $shipping->city);
                    }
                    if ($shipping->district) {
                        array_push($address, $shipping->district);
                    }
                    if ($shipping->address) {
                        array_push($address, $shipping->address);
                    }
                } else {
                    flash('亲~您还没有添加收货地址哦。');
                    return redirect('my/shipping/create');
                }
                $order = new PhoneOrder();
                $coupon = AdminCoupon::find($couponId);
                $totalFee = floatval($sku->price);
                if ($coupon) {
                    $order->coupon_id = $coupon->id;
                    $order->coupon_price = floatval($coupon->coupon_price);
                    $totalFee = floatval($sku->price) - floatval($coupon->coupon_price);
                    $userCouponData = ['coupon_id' => $couponId, 'user_id' => Session::get('uid')];
                    $userCoupon = PhoneUserToCoupon::where($userCouponData)->first();
                    if ($userCoupon) {
                        $userCoupon->is_used = 1;
                        $userCoupon->save();
                    }
                }
                if ($sku->product) {
                    $order->product_name = $sku->product->name;
                    $order->product_id = $sku->product->id;
                }
                $skuName = [];
                if ($sku->network) {
                    array_push($skuName, $sku->network->name);
                }
                if ($sku->memory) {
                    array_push($skuName, $sku->memory->name);
                }
                if ($sku->color) {
                    array_push($skuName, $sku->color->name);
                }
                if ($sku->storage) {
                    array_push($skuName, $sku->storage->name);
                }
                if ($sku->image) {
                    $order->product_image = $sku->image->image;
                }
                $order->sku_name = implode(' ', $skuName);
                $order->original_fee = floatval($sku->price);
                $order->total_fee = $totalFee;
                $order->user_id = Session::get('uid');
                $order->contacts_name = $shipping->name;
                $order->contacts_phone = $shipping->tel;
                $order->contacts_address = null;
                $order->contacts_zipcode = $shipping->zipcode;
                $order->contacts_address = implode(' ', $address);
                if ($order->save()) {
                    return redirect("order/success/$order->id");
                } else {
                    flash('亲~服务器繁忙,请稍后再试。');
                    return redirect()->back();
                }
            } else {
                flash('亲~服务器繁忙,请稍后再试。');
                return redirect()->back();
            }
        } else {
            flash('亲~服务器繁忙,请稍后再试。');
            return redirect()->back();
        }
    }

    public function success($orderId)
    {
        if ($orderId) {
            $order = PhoneOrder::find($orderId);
            if ($order) {
                return view('home.order.success')->withOrder($order);
            }
        }
        return redirect('/');
    }

    public function couponUsed()
    {
        $data = [];
        $data['msg'] = '亲~服务器繁忙,现金卷使用失败~请稍后再试。';
        $data['code'] = 404;
        $skuId = Input::get('product_id', 0);
        $couponId = Input::get('coupon_id', 0);
        if ($skuId and $couponId) {
            $sku = PhoneSku::find($skuId);
            $coupon = AdminCoupon::find($couponId);
            if ($sku and $coupon) {
                $couponPrice = floatval($coupon->coupon_price);
                $skuPrice = floatval($sku->price);
                $data['code'] = 200;
                $data['msg'] = "亲~恭喜您,商品总价已经为您减免￥{$couponPrice}元";
                $data['ret'] = [];
                $data['ret']['couponPrice'] = $couponPrice;
                if ($skuPrice > $couponPrice) {
                    $data['ret']['skuPrice'] = $skuPrice - $couponPrice;
                } else {
                    $data['ret']['skuPrice'] = 0;
                }
            }
        }
        $this->response($data);
    }

    public function response($data = [])
    {
        if (is_array($data)) {
            echo json_encode($data);
            exit();
        }
    }

}

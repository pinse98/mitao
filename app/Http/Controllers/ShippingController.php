<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\PhoneUserShipping;
use App\Services\BackUrlMsg;
use App\Services\CallBack;
use App\Services\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class ShippingController extends Controller {

    public $generator;

    protected $backMsg;

    public function __construct(UrlGenerator $generator)
    {
        $this->generator = $generator;

        $this->backMsg = new BackUrlMsg($this->generator);
    }

    public function index()
    {
        $shipping = VerifyUser::shipping(Session::get('uid'));
        if ($shipping) {
            return view('home.shipping.show')->withShipping($shipping);
        } else {
            return redirect()->back();
        }
    }

    /**
     * 添加用户收获地址
     *
     * @return \Illuminate\View\View
     */
	public function create()
	{
		return view('home.shipping.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        if (VerifyUser::shipping(Session::get('uid'))) {
            if (CallBack::has()) {
                return redirect(CallBack::get());
            } else {
                flash('亲~您已经填写收货地址了~');
                return redirect()->back();
            }

        }
        $name = Input::get('name', null);
        $province = Input::get('province', null);
        $city = Input::get('city', null);
        $district = Input::get('district', null);
        $address = Input::get('address', null);
        $zipcode = Input::get('zipcode', 0);
        $tel = Input::get('tel', 0);
        if (!$name) {
            flash('亲,真实姓名不能为空哦~请重试');
            return redirect()->back();
        }
        if (!$province or $province == '请选择省') {
            flash('亲,要选择您的所在省哦~请重试');
            return redirect()->back();
        }
        if (!$city or $province == '请选择市') {
            flash('亲,要选择您的所在市哦~请重试');
            return redirect()->back();
        }
        if (!$district or $district == '请选择区') {
            flash('亲,要选择您的所在区哦~请重试');
            return redirect()->back();
        }
        if (!$address) {
            flash('亲,收货地址不能为空哦~请重试');
            return redirect()->back();
        }

        if (!VerifyUser::zipCode($zipcode)) {
            flash('亲,邮政编码格式错误哦~请重试');
            return redirect()->back();
        }

        if (!VerifyUser::phoneCode($tel)) {
            flash('亲,手机号码格式错误哦~请重试');
            return redirect()->back();
        }
        $shipping = new PhoneUserShipping();
        $shipping->name = $name;
        $shipping->province = $province;
        $shipping->city = $city;
        $shipping->district = $district;
        $shipping->address = $address;
        $shipping->zipcode = $zipcode;
        $shipping->tel = $tel;
        $shipping->user_id = Session::get('uid');
        if ($shipping->save()) {
            if (CallBack::has()) {
                return redirect(CallBack::get());
            } else {
                return redirect('my/shipping');
            }
        } else {
            flash('亲,服务器现在压力山大~再试一下吧');
            return redirect()->back();
        }
	}

    public function edit($id)
    {
        if ($id) {
            return view('home.shipping.modify')->withShipping(PhoneUserShipping::find($id));
        } else {
            return redirect()->back();
        }
    }

    public function update($id)
    {
        if ($id) {
            $callback = Input::get('callback', null);
            if ($callback) {
                CallBack::set($callback);
            }
            $name = Input::get('name', null);
            $province = Input::get('province', null);
            $city = Input::get('city', null);
            $district = Input::get('district', null);
            $address = Input::get('address', null);
            $zipcode = Input::get('zipcode', 0);
            $tel = Input::get('tel', 0);
            if (!$name) {
                flash('亲,真实姓名不能为空哦~请重试');
                return redirect()->back();
            }

            if (!$province or $province == '请选择省') {
                flash('亲,要选择您的所在省哦~请重试');
                return redirect()->back();
            }

            if (!$city or $province == '请选择市') {
                flash('亲,要选择您的所在市哦~请重试');
                return redirect()->back();
            }

            if (!$district or $district == '请选择区') {
                flash('亲,要选择您的所在区哦~请重试');
                return redirect()->back();
            }

            if (!$address) {
                flash('亲,收货地址不能为空哦~请重试');
                return redirect()->back();
            }

            if (!VerifyUser::zipCode($zipcode)) {
                flash('亲,邮政编码格式错误哦~请重试');
                return redirect()->back();
            }

            if (!VerifyUser::phoneCode($tel)) {
                flash('亲,手机号码格式错误哦~请重试');
                return redirect()->back();
            }
            $shipping = PhoneUserShipping::find($id);
            if ($shipping) {
                $shipping->name = $name;
                $shipping->province = $province;
                $shipping->city = $city;
                $shipping->district = $district;
                $shipping->address = $address;
                $shipping->zipcode = $zipcode;
                $shipping->tel = $tel;
                if ($shipping->save()) {
                    if ($callback) {
                        return redirect(CallBack::get());
                    } else {
                        return redirect('my/shipping');
                    }
                } else {
                    flash('亲,服务器现在压力山大~再试一下吧');
                    return redirect()->back();
                }
            } else {
                flash('亲,服务器现在压力山大~再试一下吧');
                return redirect()->back();
            }
        }
    }

}

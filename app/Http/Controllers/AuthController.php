<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\VerifyCodeController;
use App\Models\PhoneUser;
use App\Services\BackUrlMsg;
use App\Services\CallBack;
use App\Services\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller {

    public $verifyCode;

    public $generator;

    public function __construct(UrlGenerator $generator)
    {
        $this->generator = $generator;

        $this->verifyCode = new VerifyCodeController();
    }

    public function login()
    {
        return view('home.auth.login');
    }

    public function postLogin()
    {
        $username = Input::get('username', null);
        $password = Input::get('password', null);
        if ($username and $password) {
            $userInfo = PhoneUser::where(['username' => $username])->first();
            if ($userInfo->username == $username) {
                if ($userInfo->password == md5($password)) {
                    Session::set('uid', $userInfo->id);
                    Session::set('username', $userInfo->username);
                    if (VerifyUser::shipping(Session::get('uid'))) {
                        return redirect(CallBack::get());
                    } else {
                        return redirect('my/shipping/create');
                    }
                } else {
                    flash('亲,密码错了哦~请重试');
                    return redirect()->back();
                }
            } else {
                flash('亲,账户不存在~请重试');
                return redirect()->back();
            }
        } else {
            flash('亲,用户名或密码不能为空~请重试');
            return redirect()->back();
        }
    }

    public function logout()
    {
        Session::remove('uid');
        Session::remove('username');
        return redirect('login');
    }

    /**
     * 用户注册视图
     *
     * @return \Illuminate\View\View
     */
    public function register()
    {
        return view('home.auth.register');
    }

    /**
     * 注册用户
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
	public function userCreate()
	{
        $username = Input::get('username', null);
        $pwd = Input::get('password', null);
        $pwdDouble = Input::get('password-double', null);
        if (VerifyUser::phoneCode($username)) {
            flash('亲,用户名必须是手机号码哦~重试一下吧');
            return redirect()->back();
        }

        if (strlen($pwd) < 6 or strlen($pwd) > 16) {
            flash('亲,密码最少需要6位哦~重试一下吧');
            return redirect()->back();
        }

        if ($pwd != $pwdDouble) {
            flash('亲,两次密码输入不一致哦~重试一下吧');
            return redirect()->back();
        }

        if (VerifyUser::user($username)) {
            flash('亲,该用户名已经被注册啦~');
            return redirect()->back();
        }

        $user = new PhoneUser();
        $user->username = $username;
        $user->password = md5($pwd);
        if ($user->save()) {
            Session::set('uid', $user->id);
            Session::set('username', $user->username);
            if (CallBack::has()) {
                return redirect(CallBack::get());
            } else {
                return redirect('/');
            }
        } else {
            flash('亲,服务器现在压力山大~再试一下吧');
            return redirect()->back();
        }
	}

}

<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Models\AdminUser;

class AdminAuthController extends Controller {

    /**
     * 后台登陆视图
     *
     * @return \Illuminate\View\View
     */
    public function login()
    {
        return view('admin.auth.login');
    }

    /**
     * 后台退出登陆
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Session::remove('admin_id');
        Session::remove('admin_user');
        Session::remove('admin_level');
        return redirect('admin/login');
    }

    /**
     * 后台验证登陆操作
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function check()
    {
        $username = Input::get('username', null);
        $password = Input::get('password', null);
        if ($username and $password) {
            $user = AdminUser::where('username', '=', $username)->first();
            if (count($user)) {
                if (sha1($password) == $user->password and $user->enable) {
                    Session::set('admin_user', $user->username);
                    Session::set('admin_id', $user->id);
                    Session::set('admin_level', $user->level);
                    if ($user->level == 1) {
                        return redirect('admin/orders/show');
                    } else {
                        return redirect('admin/promote/user/center');
                    }
                } else {
                    flash('密码错误或用户已禁用~');
                    return redirect()->back();
                }
            } else {
                flash('用户不存在~');
                return redirect()->back();
            }
        } else {
            flash('用户名或密码不能为空~');
            return redirect()->back();
        }
    }

}

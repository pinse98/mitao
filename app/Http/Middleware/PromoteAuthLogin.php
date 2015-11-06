<?php namespace App\Http\Middleware;

use App\Models\AdminUser;
use App\Models\PhoneUser;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Services\CallBack;
use Closure;

class PromoteAuthLogin
{
    public function handle($request, Closure $next)
    {
        $uid = Session::get('admin_id');
        $level = Session::get('admin_level');
        if (AdminUser::find($uid ? $uid : 0) and $level == 2) {
            return $next($request);
        } else {
            Session::remove('admin_id');
            Session::remove('admin_user');
            Session::remove('admin_level');
            return redirect('admin/login');
        }
    }
}
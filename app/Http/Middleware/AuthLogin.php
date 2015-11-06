<?php namespace App\Http\Middleware;

use App\Models\PhoneUser;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Services\CallBack;
use Closure;

class AuthLogin
{
    public $generator;

    public function __construct(UrlGenerator $generator)
    {
        $this->generator = $generator;
    }

    public function handle($request, Closure $next)
    {
        $uid = Session::get('uid');
        if (PhoneUser::find($uid ? $uid : 0)) {
            CallBack::remove();
            return $next($request);
        } else {
            CallBack::set($this->generator->current());
            return redirect('login');
        }
    }
}
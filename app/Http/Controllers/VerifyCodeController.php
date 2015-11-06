<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\VerifyCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VerifyCodeController extends Controller {

    public $sdk;

    public function __construct()
    {
        $this->sdk = new VerifyCode();
    }

    /**
     * 创建验证码
     */
    public function create()
    {
        $ret = $this->sdk->register();
        $data = [];
        if ($ret) {
            Session::set('gtserver', 1);
            $data['success'] = 1;
            $data['gt'] = $this->sdk->getCaptchaID();
            $data['challenge'] = $this->sdk->challenge;
        } else {
            Session::set('gtserver', 0);
            $rnd1 = md5(rand(0,100));
            $rnd2 = md5(rand(0,100));
            $challenge = $rnd1 . substr($rnd2,0,2);
            $data['success'] = 0;
            $data['gt'] = $this->sdk->getCaptchaID();
            $data['challenge'] = $challenge;
            Session::set('challenge', $challenge);
        }
        $this->response($data);
    }

    /**
     * 校验验证码是否合法
     *
     * @param array $data
     * @return bool
     */
    public function verify($data = [])
    {
        $ret = false;
        $geetest_challenge = isset($data['geetest_challenge']) ? $data['geetest_challenge'] : null;
        $geetest_validate = isset($data['geetest_validate']) ? $data['geetest_validate'] : null;
        $geetest_seccode = isset($data['geetest_seccode']) ? $data['geetest_seccode'] : null;
        if (Session::get('gtserver')) {
            if ($this->sdk->validate($geetest_challenge, $geetest_validate, $geetest_seccode)) {
                $ret = true;
            }
        } else {
            if ($this->sdk->get_answer($geetest_validate)) {
                $ret = true;
            }
        }
        return $ret;
    }

    private function response($res)
    {
        echo json_encode($res);
    }
}

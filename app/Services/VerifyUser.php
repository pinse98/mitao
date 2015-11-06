<?php namespace App\Services;

use App\Models\PhoneUser;
use App\Models\PhoneUserShipping;
use Illuminate\Support\Facades\Session;

class VerifyUser
{
    /**
     * 检查用户是否有配送信息
     *
     * @param int $uid
     * @return bool
     */
    public static function shipping($uid = 0)
    {
        $ret = false;
        if ($uid) {
            $shipping = PhoneUserShipping::where(['user_id' => $uid])->first();
            if ($shipping) {
                $ret = $shipping;
            }
        }
        return $ret;
    }

    /**
     * 检查用户名是否被注册
     *
     * @param null $username
     * @return null
     */
    public static function user($username = null)
    {
        $ret = false;
        if ($username) {
            $user = PhoneUser::where(['username' => $username])->get();
            if (count($user)) {
                $ret = $user[0];
            }
        }
        return $ret;
    }

    /**
     * 验证邮编是否正确
     *
     * @param int $zipCode
     * @return bool
     */
    public static function zipCode($zipCode = 0)
    {
        $ret = false;
        if ($zipCode) {
            $zip_search = '/^\d{6}$/';
            if (preg_match($zip_search, $zipCode)) {
                $ret = true;
            }
        }
        return $ret;
    }

    /**
     * 验证手机号码是否正确
     *
     * @param null $phoneCode
     * @return bool
     */
    public static function phoneCode($phoneCode = null)
    {
        $ret = false;
        if ($phoneCode) {
            $tel_search ='/^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/';
            if (preg_match($tel_search, $phoneCode)) {
                $ret = true;
            }
        }
        return $ret;
    }
}
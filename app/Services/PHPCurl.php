<?php namespace App\Services;

use Curl\Curl;

class PHPCurl
{
    protected static $curl = null;

    protected static function init()
    {
        if (self::$curl == null) {
            self::$curl = new Curl();
        }
        return self::$curl;
    }

    public static function get($url, $data = array())
    {
        $ret = null;
        self::init()->get($url, $data);
        if (!self::init()->error) {
            $ret = self::init()->response;
        }
        return $ret;
    }

    public static function post($url, $data = array())
    {
        $ret = null;
        self::init()->post($url, $data);
        if (self::init()->error) {
            $ret = self::init()->response;
        }
        return $ret;
    }
}
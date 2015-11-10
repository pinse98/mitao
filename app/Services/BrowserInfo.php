<?php namespace App\Services;

use Jenssegers\Agent\Agent;

class BrowserInfo
{
    protected static $agent;

    protected static function init()
    {
        if (self::$agent == null) {
            self::$agent = new Agent();
        }
        return self::$agent;
    }

    /**
     * 获取浏览器内核名称
     *
     * @return string
     */
    public static function browser()
    {
        return self::init()->browser();
    }

    /**
     * 获取浏览器内核版本
     *
     * @return float|string
     */
    public static function browserVersion()
    {
        return self::init()->version(self::browser());
    }

    /**
     * 获取系统名称
     *
     * @return string
     */
    public static function platform()
    {
        return self::init()->platform();
    }

    /**
     * 获取系统版本
     *
     * @return float|mixed|string
     */
    public static function platformVersion()
    {
        $ret = self::init()->version(self::platform());
        $ret = str_replace('_', '.', $ret);
        return $ret;
    }

    /**
     * 获取userAgent
     *
     * @return null|string
     */
    public static function userAgent()
    {
        return self::init()->getUserAgent();
    }

    /**
     * 获取设备信息
     *
     * @return string
     */
    public static function device()
    {
        return self::init()->device();
    }
}
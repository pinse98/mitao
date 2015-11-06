<?php namespace App\Services;

use Illuminate\Support\Facades\Session;

class CallBack
{
    public static $name = 'callback';

    public static function set($value = null)
    {
        Session::set(self::$name, $value);
    }

    public static function get()
    {
        return Session::get(self::$name);
    }

    public static function remove()
    {
        return Session::remove(self::$name);
    }

    public static function update($value)
    {
        Session::set(self::$name, $value);
    }

    public static function has()
    {
        return Session::has(self::$name);
    }
}
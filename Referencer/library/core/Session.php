<?php

/**
 * Created by PhpStorm.
 * User: Script47
 * Date: 01/04/2017
 * Time: 21:41
 */
class Session
{
    public static function start()
    {
        return session_start();
    }

    public static function is_started(): bool
    {
        return isset($_SESSION) && !empty(session_id()) ? true : false;
    }

    public static function add(string $key, $value)
    {
        return $_SESSION[$key] = $value;
    }

    public static function get(string $key)
    {
        return $_SESSION[$key];
    }

    public static function exists(string $key)
    {
        return (isset($_SESSION[$key]) && !empty($_SESSION[$key])) ? true : false;
    }

    public static function remove($key)
    {
        unset($_SESSION[$key]);
    }

    public static function end()
    {
        session_unset();
        session_destroy();
    }
}
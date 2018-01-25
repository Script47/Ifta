<?php

/**
 * Created by PhpStorm.
 * User: Script47
 * Date: 19/03/2017
 * Time: 12:31
 */
class Sanitize
{
    /**
     * @param string $string
     * @return string
     */
    public static function username(string $string): string
    {
        return preg_replace('/[^A-Za-z0-9_-]/', '', trim($string));
    }

    /**
     * @param $string
     * @return mixed
     */
    public static function string($string): string
    {
        return preg_replace('/[^a-zA-Z]/', '', trim($string));
    }

    public static function int($int): int
    {
        return intval($int);
    }

    public static function float($float): float
    {
        return floatval($float);
    }

    public static function bool($bool): bool
    {
        return boolval($bool);
    }

    public static function email_address($email_address): string
    {
        return filter_var($email_address, FILTER_SANITIZE_EMAIL);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Script47
 * Date: 10/07/2017
 * Time: 03:42
 */

class Validate
{
    public static function int(int $int) : bool
    {
        return filter_var($int, FILTER_VALIDATE_INT) !== false ? true : false;
    }

    public static function float(float $float): bool
    {
        return filter_var($float, FILTER_VALIDATE_FLOAT) !== false ? true : false;
    }

    public static function bool(bool $bool): bool
    {
        return filter_var($bool, FILTER_VALIDATE_BOOLEAN) !== false ? true : false;
    }
    
    public static function email_address(string $email_address): bool
    {
        return filter_var($email_address, FILTER_VALIDATE_EMAIL) !== false ? true : false;
    }
}
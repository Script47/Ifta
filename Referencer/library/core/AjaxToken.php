<?php

/**
 * Created by PhpStorm.
 * User: Script47
 * Date: 19/03/2017
 * Time: 11:27
 */
class AjaxToken
{
    public static function verify(string $token): bool
    {
        return Database::run('SELECT token FROM ajax_token WHERE token = ? LIMIT 1', [$token])->rowCount();
    }

    public static function get(): string
    {
        return Database::run('SELECT token FROM ajax_token ORDER BY RAND() LIMIT 1')->fetch()->token;
    }
}
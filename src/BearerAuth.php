<?php
/**
 * Created by PhpStorm.
 * User: darkfriend <hi@darkfriend.ru>
 * Date: 07.04.2021
 * Time: 16:53
 */

namespace darkfriend\helpers;


class BearerAuth
{
    /**
     * Header name
     * @var string
     */
    protected static $header = 'Authorization';

    /**
     * Pattern for parse
     * @var string
     */
    protected static $pattern = '/^Bearer\s+(.*?)$/';

    /**
     * Get bearer token
     * @param HeaderCollection $header
     * @return string
     */
    public static function getToken(HeaderCollection $header): string
    {
        $value = $header->get(static::$header);

        if (static::$pattern && $value && \preg_match(static::$pattern, $value, $matches)) {
            return (string) $matches[1];
        }

        return '';
    }
}
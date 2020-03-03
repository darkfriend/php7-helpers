<?php
/**
 * Created by PhpStorm.
 * User: darkfriend <hi@darkfriend.ru>
 * Date: 23.02.2020
 * Time: 23:05
 */

namespace darkfriend\helpers;

/**
 * Class DateTimeHelper
 * @package darkfriend\helpers
 * @since 1.0.2
 */
class DateTimeHelper
{
    /**
     * Return amount seconds before end day
     * @return int amount seconds
     * @since 1.0.2
     */
    public static function getAmountEndDay(): int
    {
        return static::getAmountSeconds(strtotime("tomorrow") - 1);
//        $res = (strtotime("tomorrow") - 1)-strtotime('now');
//        return $res ?? 3600;
    }

    /**
     * Return amount seconds before $endTime
     * @param mixed $endTime
     * @return int amount seconds
     * @since 1.0.2
     */
    public static function getAmountSeconds($endTime): int
    {
        if(!is_numeric($endTime)) {
            $endTime = strtotime($endTime);
        }
        return $endTime-strtotime('now');
    }
}
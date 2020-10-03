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
 * @since 1.0.3
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

    /**
     * Get age
     * @param string|\DateTime $date1
     * @param string|\DateTime $date2
     * @return int
     * @throws \Exception
     * @since 1.0.7
     */
    public static function getAge($date1, $date2 = 'now'): int
    {
        if(!($date1 instanceof \DateTime)) {
            $date1 = new \DateTime($date1);
        }
        if(!($date2 instanceof \DateTime)) {
            $date2 = new \DateTime($date2);
        }
        return (int) $date1->diff($date2)->y;
    }
}
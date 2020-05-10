<?php

namespace darkfriend\helpers;

/**
 * Class ErrorHelper
 * @package darkfriend\helpers
 * @author darkfriend <hi@darkfriend.ru>
 * @version 1.0.0
 * @since 1.0.3
 */
class ErrorHelper
{
    /**
     * Преобразует ошибки из в массива в строку
     * @param array $errors
     * @return string
     */
    public static function toStr($errors): string
    {
        if (!$errors) return '';
        if (ArrayHelper::isMulti($errors)) {
            $allError = [];
            foreach ($errors as $error) {
                $allError[] = \implode(\PHP_EOL, $error);
            }
            return \implode(\PHP_EOL, $allError);
        } else {
            return \implode(\PHP_EOL, $errors);
        }
    }
}
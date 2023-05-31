<?php
/**
 * Created by PhpStorm.
 * User: shranet
 * Date: 12/5/18
 * Time: 12:09 PM
 */
namespace common\components;

use DateTime;
use yii\helpers\ArrayHelper;

/**
 * Class Time
 * @package app\components
 */
class Time
{
    /**
     * @return false|string
     */
    public static function nowFull()
    {
        return date("Y-m-d H:i:s");
    }

    /**
     * @param $days
     * @return false|string
     */
    public static function futureDay($days = 0)
    {
        return date("Y-m-d H:i:s",strtotime(time()."+ $days days"));
    }


    /**
     * @return false|string
     */
    public static function nowShort()
    {
        return date("Y-m-d");
    }

    /**
     * @param $date
     * @param string $date2
     * @return \DateInterval|false
     * @throws \Exception
     */
    public static function diff($date, $date2 = 'now')
    {
        $datetime1 = new DateTime(date('Y-m-d H:i:s',strtotime($date)));
        $datetime2 = new DateTime($date2=='now'?$date2:date('Y-m-d H:i:s',strtotime($date2)));
        return $datetime2->diff($datetime1);
    }

    /**
     * @return array
     */
    public static function days(): array
    {
        return [
            1 => t("Monday"),
            2 => t("Tuesday"),
            3 => t("Wednesday"),
            4 => t("Thursday"),
            5 => t("Friday"),
            6 => t("Saturday"),
            7 => t("Sunday")
        ];
    }


    /**
     * @param $day
     * @return string
     */
    public static function getDayText($day): string
    {
        return t("{n,plural, one{# день} few{# дня} many{# дней} other{# дня}}", ["n" => $day]);
    }

    /**
     * @param $minute
     * @return string
     */
    public static function getMinuteText($minute): string
    {
        return t("{n,plural, one{# минута} few{# минуты} many{# минут} other{# минуты}}", ["n" => $minute]);
    }

    /**
     * @param $hour
     * @return string
     */
    public static function getHourText($hour): string
    {
        return t("{n,plural, one{# час} few{# часа} many{# часов} other{# часа}}", ["n" => $hour]);
    }

    /**
     * @param $month
     * @return string
     */
    public static function getMonthText($month): string
    {
        return t("{n,plural, one{# месяц} few{# месяца} many{# месяцев} other{# месяца}}", ["n" => $month]);
    }

    /**
     * @param $year
     * @return string
     */
    public static function getYearText($year): string
    {
        return t("{n,plural, one{# год} few{# года} many{# лет} other{# года}}", ["n" => $year]);
    }

    /**
     * @param $m
     * @return mixed
     */
    public static function getSingleMonth($m){
        return ArrayHelper::getValue(self::getMonth(),$m);
    }

    /**
     * @param $m
     * @return mixed
     */
    public static function getSingleShortMonth($m){
        return ArrayHelper::getValue(self::getShortMoth(),$m);
    }

    /**
     * @param $seconds
     * @return string
     */
    public static function secondsToText ($seconds){
        $minute = intval($seconds / 60);
        $time = '---';
        if ($minute>=60) {
            $hour = intval($minute/60);
            $minute = intval($minute%60);
            $time = self::getHourText($hour);
            if ($minute!=0) {
                $time .= ' ' . self::getMinuteText($minute);
            }
        }elseif($time){
            $time = ' '.self::getMinuteText($minute>0?$minute:1);
        }
        return $time;
    }

    public static function getDateFormat($value, $format)
    {
        return date($format, strtotime($value));

    }


    /**
     * @return array
     */
    public static function getMonth()
    {
        return  [
            1=>t("Январь"),
            2=>t("Февраль"),
            3=>t("Март"),
            4=>t("Апрель"),
            5=>t("Май"),
            6=>t("Июнь"),
            7=>t("Июль"),
            8=>t("Август"),
            9=>t("Сентябрь"),
            10=>t("Октябрь"),
            11=>t("Ноябрь"),
            12=>t("Декабрь")
        ];
    }

    /**
     * @return array
     */
    public static function getShortMoth()
    {
        return [
            1=>t("Янв"),
            t("Фев"),
            t("Мар"),
            t("Апр"),
            t("Май"),
            t("Июн"),
            t("Июл"),
            t("Авг"),
            t("Сен"),
            t("Окт"),
            t("Ноя"),
            t("Дек")
        ];
    }

}



























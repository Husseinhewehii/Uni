<?php

namespace App\Constants;

final class WeekDaysTypes
{
    const SATURDAY = 1;
    const SUNDAY = 2;
    const MONDAY = 3;
    const TUESDAY = 4;
    const WEDNESDAY = 5;
    const THURSDAY = 6;
    const FRIDAY = 7;

    public static function getList()
    {
        return [
            WeekDaysTypes::SATURDAY => trans("saturday"),
            WeekDaysTypes::SUNDAY => trans("sunday"),
            WeekDaysTypes::MONDAY => trans("monday"),
            WeekDaysTypes::TUESDAY => trans("tuesday"),
            WeekDaysTypes::WEDNESDAY => trans("wednesday"),
            WeekDaysTypes::THURSDAY => trans("thursday"),
            WeekDaysTypes::FRIDAY => trans("friday"),

        ];
    }

    public static function getOne($key = '')
    {
        if (!array_key_exists($key, self::getList())) {
            return "";
        }
        return self::getList()[$key];
    }
    public static function getApiList()
    {
        foreach (self::getList() as $key => $value) {
            $weekDaysArray[] = ['id' => $key, 'name' => $value];
        }

        return $weekDaysArray;
    }

}

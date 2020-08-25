<?php

namespace App\Constants;

final class UserTypes
{
    const ADMIN = 1;
    const STUDENT = 2;
    const PROFESSOR = 3;

    public static function getList()
    {
        return [
            UserTypes::ADMIN => "Admin",
            UserTypes::STUDENT => "Student",
            UserTypes::PROFESSOR => "Professor"

        ];
    }

    public static function getOne($index = '')
    {
        $list = self::getList();
        $list_one = '';
        if ($index) {
            $list_one = $list[$index];
        }
        return $list_one;
    }

}

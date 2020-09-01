<?php

namespace App\Constants;

use phpDocumentor\Reflection\Types\Self_;

final class ObjectTypes
{

    const COURSE= 'App\Models\Course';
    const USER = 'App\Models\User';
    const GROUP = 'App\Models\Group';
    const PERMISSION = 'App\Models\Permission';
    const GROUP_PERMISSION = 'App\Models\GroupPermission';

    public static function getKeyList()
    {
        return array_keys(self::getList());
    }

    public static function getList()
    {
        return [

            ObjectTypes::USER => trans("user"),
            ObjectTypes::COURSE => trans("course"),
            ObjectTypes::PERMISSION => trans("permission"),
            ObjectTypes::GROUP => trans("groups"),
            ObjectTypes::GROUP_PERMISSION => trans("groupPermissions")
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

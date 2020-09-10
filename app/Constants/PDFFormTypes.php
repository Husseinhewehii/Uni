<?php

namespace App\Constants;

use Barryvdh\DomPDF\PDF;

final class PDFFormTypes
{
    const FormOne = 1;
    const FormTwo = 2;

    public static function getList()
    {
        return [
            PDFFormTypes::FormOne => "form_one",
            PDFFormTypes::FormTwo => "form_two",
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

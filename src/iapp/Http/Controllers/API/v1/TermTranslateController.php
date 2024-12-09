<?php


/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 9/1/20, 7:24 AM
 * Copyright (c) 2020. Powered by iamir.net
 */

namespace iLaravel\iTranslatePost\iApp\Http\Controllers\API\v1;

use iLaravel\iTranslate\iApp\Http\Controllers\API\v1\TranslateModelController;

class TermTranslateController extends TranslateModelController
{
    public $order_list = ['id', 'title','slug','type','description','status', 'local'];

    public static $_self_key = true;

    use TermTranslate\Filters,
        TermTranslate\RequestData;
}

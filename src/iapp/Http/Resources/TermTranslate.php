<?php


/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 9/15/20, 1:10 PM
 * Copyright (c) 2020. Powered by iamir.net
 */

namespace iLaravel\iTranslatePost\iApp\Http\Resources;

use iLaravel\Core\iApp\Http\Resources\Resource;
use iLaravel\iTranslate\iApp\TranslateLocal;

class TermTranslate extends Resource
{
    public function toArray($request)
    {
        $data = parent::toArray($request);
        if (isset($data['local']) && $data['local']) {
            $translateLocal = TranslateLocal::where('code', $data['local'])->first();
            $data['local'] = [
                'text' => $translateLocal ? $translateLocal->name : $data['local'],
                'value' => $data['local'],
            ];
        }
        return $data;
    }
}

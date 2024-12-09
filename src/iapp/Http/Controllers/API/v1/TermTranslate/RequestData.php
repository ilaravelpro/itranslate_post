<?php
/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 2/21/21, 6:07 PM
 * Copyright (c) 2021. Powered by iamir.net
 */

namespace iLaravel\iTranslatePost\iApp\Http\Controllers\API\v1\TermTranslate;

use iLaravel\Core\iApp\Http\Requests\iLaravel as Request;


trait RequestData
{
    public function requestData(Request $request, $action, &$data)
    {
        parent::requestData($request, $action, $data);
        if (in_array($action, ['store', 'update'])) {
            if (isset($data['title']) && (!isset($data['slug']) || (isset($data['slug']) && !strlen($data['slug'])))) {
                $data['slug'] = to_slug($data['title']);
            }
        }
    }
}

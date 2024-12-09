<?php



/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 9/1/20, 7:24 AM
 * Copyright (c) 2020. Powered by iamir.net
 */

namespace iLaravel\iTranslatePost\iApp\Http\Controllers\API\v1\TermTranslate;


trait Filters
{
    public function filters($request, $model, $parent = null, $operators = [])
    {
        $filters = [
            [
                'name' => 'all',
                'title' => _t('all'),
                'type' => 'text',
            ],
            [
                'name' => 'term_id',
                'title' => _t('term'),
                'type' => 'text',
                'rule' => 'exists_serial:Term'
            ],
            [
                'name' => 'title',
                'title' => _t('title'),
                'type' => 'text',
            ],
            [
                'name' => 'slug',
                'title' => _t('slug'),
                'type' => 'text',
            ],
            [
                'name' => 'description',
                'title' => _t('description'),
                'type' => 'text',
            ],
        ];
        return [$filters, [], $operators];
    }
}

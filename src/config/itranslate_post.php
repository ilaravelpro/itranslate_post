<?php


/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 9/16/20, 9:21 PM
 * Copyright (c) 2020. Powered by iamir.net
 */

return [
    'routes' => [
        'api' => [
            'status' => true,
            'terms' => ['status' => true],
            'messages' => ['status' => true],
            'models' => ['status' => true],
            'indexes' => ['status' => true],
        ]
    ],
    'database' => [
        'migrations' => [
            'include' => true,
            'locals' => ['include' => true],
            'models' => ['include' => true],
            'messages' => ['include' => true],
            'indexes' => ['include' => true],
        ],
    ],
];
?>

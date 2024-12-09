<?php


/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 9/13/20, 8:07 AM
 * Copyright (c) 2020. Powered by iamir.net
 */

function itranslate_post_path($path = null)
{
    $path = trim($path, '/');
    return __DIR__ . ($path ? "/$path" : '');
}

function itranslate_post($key = null, $default = null)
{
    return iconfig('itranslate_post' . ($key ? ".$key" : ''), $default);
}

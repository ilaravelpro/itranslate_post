<?php


/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 9/15/20, 1:10 PM
 * Copyright (c) 2020. Powered by iamir.net
 */

namespace iLaravel\iTranslatePost\iApp\Http\Resources;

use iLaravel\Core\iApp\Attachment;
use iLaravel\Core\iApp\Http\Resources\File;
use iLaravel\Core\iApp\Http\Resources\Resource;
use iLaravel\iTranslate\iApp\TranslateLocal;

class PostTranslate extends Resource
{
    public function toArray($request)
    {
        $data = parent::toArray($request);
        if ($this->creator_id)
            $data['creator_id'] = [
                'text' => $this->creator->fullname,
                'value' => $this->creator->serial,
            ];
        if ($this->post_id)
            $data['post_id'] = [
                'text' => $this->post->title,
                'value' => $this->post->serial,
            ];
        if ($this->tags && count($this->tags))
            $data['tags'] = $this->tags->pluck('title')->toArray();
        if (isset($data['local']) && $data['local']) {
            $translateLocal = TranslateLocal::where('code', $data['local'])->first();
            $data['local'] = [
                'text' => $translateLocal ? $translateLocal->name : $data['local'],
                'value' => $data['local'],
            ];
        }
        $fileModel = imodal('File');
        $postModel = imodal('Post');
        if (isset($data['content']) && is_array($data['content'])) {
            foreach ($postModel::reviewFiles($data['content'], '', false) as $item) {
                $cValue = _get_value($data['content'], "{$item}_id");
                if ($cValue) {
                    $data['content'] = _set_value($data['content'], "{$item}_id", is_int($cValue) ? Attachment::serial($cValue) : $cValue);
                    $data['content'] = _set_value($data['content'], $item, File::collection($fileModel::where('post_id', is_int($cValue) ? $cValue : Attachment::id($cValue))->get()->keyBy('mode')));
                }
            }
        }
        return $data;
    }
}

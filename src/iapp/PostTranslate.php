<?php
/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 12/20/20, 8:27 AM
 * Copyright (c) 2020. Powered by iamir.net
 */

namespace iLaravel\iTranslatePost\iApp;

use App\Post;
use iLaravel\Core\iApp\Http\Requests\iLaravel as Request;

class PostTranslate extends \iLaravel\Core\iApp\Model
{
    use \iLaravel\iTranslate\iApp\Traits\Model;
    use \iLaravel\iPost\iApp\Traits\SaveTags;
    use \iLaravel\iPost\iApp\Traits\SetSlug;
    public static $s_prefix = "IPRPT";
    public static $s_start = 21869999999;
    public static $s_end = 634229999999;
    public static $t_model_class = Post::class;
    public static $t_model_type = 'Post';
    public static $t_model_key = 'post_id';

    protected static function boot()
    {
        parent::boot();
        static::iPostSlugBoot();
        parent::creating(function (self $event) {
            if ($event->hasTableColumn('type') && isset(static::getTModelClass()::$post_type))
                $event->type = static::getTModelClass()::$post_type;
        });
        parent::deleting(function (self $event) {
            if (method_exists($event, 'tags'))
                $event->tags()->detach();
        });
    }
    public function creator()
    {
        return $this->belongsTo(imodal('User'));
    }

    public function additionalUpdate($request = null, $additional = null, $parent = null)
    {
        $additional = $additional ?: $this->getAdditional();
        if (method_exists(parent::class, 'additionalUpdate'))
            parent::additionalUpdate($request, $additional, $parent);
        $this->save_tags($additional);
        $this->save();
    }

    public function rules(Request $request, $action, $arg1 = null)
    {
        $rules = [];
        $additionalRules = [
            'image_file' => 'nullable|mimes:jpeg,jpg,png,gif|max:5120',
            'tags.*' => "nullable",
        ];
        switch ($action) {
            case 'store':
            case 'update':
                $rules = array_merge($rules,$additionalRules, [
                    'organization_id' => "required|exists:posts,id",
                    'title' => "required|string",
                    'slug' => ['nullable','slug'],
                    'content' => "nullable|string",
                    'summary' => "nullable|string",
                    'local' => "required|exists:translate_locals,code",
                    'status' => 'nullable|in:' . join(',', iconfig('status.post_translates', iconfig('status.global'))),

                ]);
                /*$rules['slug'][] = Rule::unique('terms', 'slug')->where(function ($query) use ($request, $arg1) {
                    if ($arg1)
                        $query->where('id', '!=', $arg1->id);
                    $query->where('slug', $request->slug? : $arg1->slug)->where('local', $request->local ? : $arg1->local);
                });*/
                break;
            case 'additional':
                $rules = $additionalRules;
                break;
        }
        return $rules;
    }

    public static function findBySlug($slug)
    {
        return static::where('slug', $slug)->first();
    }

    public static function slug($slug)
    {
        $item = static::findBySlug($slug);
        return $item ? $item->id : null;
    }

    public function tags()
    {
        return $this->belongsToMany(imodal('Tag'), 'post_translates_tags', 'translate_id');
    }

    public function post()
    {
        return $this->belongsTo(imodal(str_replace('Translate', '', class_name(static::class))), 'post_id');
    }
}

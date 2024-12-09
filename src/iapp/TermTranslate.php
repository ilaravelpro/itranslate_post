<?php
/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 12/20/20, 8:27 AM
 * Copyright (c) 2020. Powered by iamir.net
 */

namespace iLaravel\iTranslatePost\iApp;

use App\Term;
use Illuminate\Validation\Rule;
use iLaravel\Core\iApp\Http\Requests\iLaravel as Request;

class TermTranslate extends \iLaravel\Core\iApp\Model
{
    use \iLaravel\iTranslate\iApp\Traits\Model;
    public static $s_prefix = "ITRPT";
    public static $s_start = 21869999999;
    public static $s_end = 634229999999;
    public static $t_model_class = Term::class;
    public static $t_model_type = 'Term';
    public static $t_model_key = 'term_id';

    public function rules(Request $request, $action, $arg1 = null)
    {
        $arg1 = is_string($arg1) ? $this::findBySerial($arg1) : $arg1;
        $rules = [];
        $additionalRules = [
        ];
        switch ($action) {
            case 'store':
                $rules['term_id'] = "required|exists:terms,id";
            case 'update':
                $rules = array_merge($rules,$additionalRules, [
                    'local' => "required|exists:translate_locals,code",
                    'title' => "required|string",
                    'slug' => ['nullable','slug'],
                    'description' => "nullable|string",
                    'status' => 'nullable|in:' . join(',', iconfig('status.terms', iconfig('status.global'))),
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
}

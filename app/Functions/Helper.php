<?php

namespace App\functions;

use Illuminate\Support\Str;


class Helper
{
    public static function generateSlug($string, $model)
    {
        $slug = Str::slug($string, '-');
        $original_slug = $slug;

        $exist = $model::where('slug', $slug)->first();
        $counter = 1;

        while ($exist) {
            $slug = $original_slug . '-' . $counter;
            $exist = $model::where('slug', $slug)->first();
            $counter++;
        }

        return $slug;
    }
}

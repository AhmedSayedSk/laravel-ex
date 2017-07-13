<?php

use Illuminate\Support\Facades\DB;

function trans2($id, $attrs = null) {
    $locale = config('app.locale');
    $result = DB::table('translation')->select($locale)->where('id', $id)->first()->$locale;

    if($attrs != null){
        foreach ($attrs as $key => $attr) {
            $result = str_replace("::$key", $attr, $result);
        }
    }

    return $result;
}
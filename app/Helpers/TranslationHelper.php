<?php

use Illuminate\Support\Facades\DB;

function trans2($id, $origin, $attrs = null) {
    $locale = config('app.locale');
    $check = DB::table('translation')->where('id_num', $id)->count();

    if(!$check){
        DB::table('translation')->insert([
            'en' => $origin
        ]);

        $result = $origin;
    } else {
        $old = DB::table('translation')->select($locale)->where('id_num', $id)->first()->$locale;

        if($locale == 'en'){
            if($old != $origin){
                DB::table('translation')->where('id_num', $id)->update([
                    $locale => $origin
                ]);
            }
            
            $result = $origin;
        } else {
            $result = $old;
        }
    }

    if($attrs != null){
        foreach ($attrs as $key => $attr) {
            $result = str_replace("::$key", $attr, $result);
        }
    }

    return $result;
}
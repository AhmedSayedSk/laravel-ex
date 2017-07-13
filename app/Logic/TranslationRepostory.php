<?php

namespace App\Logic;

use DB;
use Storage;

class TranslationRepostory
{
    public function storeData(){
        $translation = DB::table('translation')->get();

        if(count($translation) >= 1){
            Storage::put('translation.json', json_encode((object) $translation));
        }
        
        return true;
    }
}
<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Schema;
use Storage;
use Session;
use Response;

class translationController extends Controller
{
    protected function unsupportedTranslations(){
        $table_comments = DB::select("SELECT COLUMN_COMMENT FROM information_schema.COLUMNS WHERE TABLE_NAME = 'translation'");
        $table_columns = Schema::getColumnListing('translation');

        $tableColumnsAndComments = [];
        $i = 0;

        foreach ($table_comments as $comment) {
            $tableColumnsAndComments[$table_columns[$i]] = $comment->COLUMN_COMMENT;
            $i++;
        }

        $supported_translations = (array) json_decode(Storage::get('supported_translations.json'));

        unset($tableColumnsAndComments['id_num']);

        foreach ($supported_translations as $key => $value) {
            unset($tableColumnsAndComments[$key]);
        }

        return $tableColumnsAndComments;
    }

    public function index(){
        $translations = DB::table('translation')->paginate(50);
        $unsupportedTranslations = $this->unsupportedTranslations();
        $supported_trans = json_decode(Storage::get('supported_translations.json'));

        $displayed_trans = [];

        foreach ($supported_trans as $key => $value) {
            if($value->display)
                $displayed_trans[] = $key;
        }

        return view('back.translations.view')->with(compact(
            'translations', 'unsupportedTranslations', 'displayed_trans',
            'supported_trans'
        ));
    }

    /*public function create(){
        $supported_trans = json_decode(Storage::get('supported_translations.json'));
        $displayed_trans = [];

        foreach ($supported_trans as $key => $value) {
            if($value->display)
                $displayed_trans[] = $key;
        }

        return view('back.translations.modals.create')->with(compact(
            'displayed_trans', 'supported_trans'
        ));
    }*/

    public function store(Request $request){
        $inputs = (array) $request->all();

        unset($inputs['_token']);

        DB::table('translation')->insert($inputs);

        return Response::json([
            'error' => false,
            'message' => 'Success insert translations',
            'status' => 200
        ], 200);
    }

    public function update($id, Request $request){
        $inputs = (object) $request->all();

        DB::table('translation')->where('id_num', $id)->update([
            $inputs->key => $inputs->content
        ]);

        return Response::json([
            'error' => false,
            'content' => $inputs->content,
            'status' => 200
        ], 200);
    }

    public function takeBackup(){
        $supported_translations = (array) json_decode(Storage::get('supported_translations.json'));
        
        $translation = DB::table('translation')
            ->select(array_merge(['id_num'], array_keys($supported_translations)))
            ->get();

        $unique_value = round(time()/60) * 60;

        if(count($translation) >= 1){
            Storage::put("backups/translations_DB/translation_$unique_value.json", json_encode((object) $translation));
        }

        Session::flash('flashMessage', [
            "type" => "success",
            "content" => 'A copy of the translations was successfully taken'
        ]);

        return back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Storage;
use Session;
use Response;

class translationController extends Controller
{
    public function index(){
        $translations = DB::table('translation')->paginate(50);

        return view('back.translations.view')->with(compact(
            'translations'
        ));
    }

    public function create(){
        return view('back.translations.modals.create');
    }

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

        DB::table('translation')->where('id', $id)->update([
            $inputs->key => $inputs->content
        ]);

        return Response::json([
            'error' => false,
            'content' => $inputs->content,
            'status' => 200
        ], 200);
    }

    public function takeBackup(){
        $translation = DB::table('translation')->get();
        $unique_value = round(time()/60) * 60;

        if(count($translation) >= 1){
            Storage::put("backups/translation_$unique_value.json", json_encode((object) $translation));
        }

        Session::flash('flashMessage', [
            "type" => "success",
            "content" => 'A copy of the translations was successfully taken'
        ]);

        return back();
    }
}

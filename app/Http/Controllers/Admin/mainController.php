<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SiteSettingRequest;
use App\Http\Controllers\Controller;

use App\Models\Product\Product;

use DB;
use Storage;
use Session;
use Visitor;

class mainController extends Controller
{
    public function __construct(){
        $this->middleware('authenticated:super_admin', ['only' => ['getSiteSetting', 'postSiteSetting']]);
    }

    public function getIndex(){
    	$products_count = Product::count();
    	$live_products_count = Product::where("is_live", 1)->count();
    	$products_carousel_count = Product::users_roles()->products_carousel()->count();
        $visitor_count = Visitor::count();
        $visitor_count_lastWeek = Visitor::range(date("d-m-Y", time() - 7 * 24 * 60 * 60), date("d-m-Y", time()));

        for ($i=1; $i <= 4; $i++) { 
            $products_categories[] = DB::table("products_categories_$i")->get();
        }

        return view("back.dashboard")->with(compact(
            'products_count', 'live_products_count', 'products_carousel_count',
            'products_categories', 'visitor_count', 'visitor_count_lastWeek'
        ));
    }

    public function getDocumentations(){
        return view('back.documentations');
    }

    public function getSiteSetting(){
        $site_setting = json_decode(Storage::get("setting.json"));

        $newStatusTimeOff = trans('admin_setting.timeOff');
        $currencies = trans('admin_setting.currencies');

        return view('back.site-setting')->with(compact(
            'site_setting', 'currencies', 'newStatusTimeOff'
        ));
    }

    public function postSiteSetting(SiteSettingRequest $request){
        $inputs = (object) $request->all();

        $data1 = json_decode(Storage::get("setting.json"));

        $data1->site_name = $inputs->site_name;
        $data1->site_category = $inputs->site_category;
        $data1->customer_service_number = $inputs->customer_service_number;
        $data1->main_currency = $inputs->main_currency;
        $data1->newStatusTimeOff = $inputs->newStatusTimeOff;
        $data1->is_clear_cart_when_logout = $inputs->clear_cart_when_logout;

        $data2 = json_encode($data1);
        Storage::put("setting.json", $data2);

        Session::flash('flashMessage', [
            "type" => "success",
            "content" => trans('admin_panel.ASSP.T10')
        ]);

        return back();
    }
}

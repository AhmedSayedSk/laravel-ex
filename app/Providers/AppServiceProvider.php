<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Product\Product;
use App\Models\Admin\Admin;

use Visitor;
use Storage;
use Cart;
use DB;

class AppServiceProvider extends ServiceProvider
{

    public function boot() {
        //Visitor::log();

        view()->composer('*', function ($view) {
            for ($i = 1; $i <= 4; $i++) { 
                $p_cats[] = DB::table("products_categories_$i")->get();
            }

            $global_setting = json_decode(Storage::get('setting.json'));

            $locale = config('app.locale');
            $static_setting = json_decode(Storage::get("static_setting.json"))->currencies->$locale;
            $static_setting = explode(',', $static_setting);

            $view->with([
                'global_setting' => $global_setting,
            	'main_currency' => $static_setting[$global_setting->main_currency],
        		'frontendNumber' => config('setting.frontendNumber'),
            	'personType' => Admin::type(),
                'cart_count' => Cart::getContent()->count(),
            	'publicProdcutsCats' => $p_cats,
            ]);
        });
    }

    public function register() {

    }
}

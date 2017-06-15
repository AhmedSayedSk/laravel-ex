<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Product\Product;
use App\Models\Admin\Admin;

use Schema;
use Visitor;
use Storage;
use Cart;
use DB;

class AppServiceProvider extends ServiceProvider
{

    public function boot() {

        if (Schema::hasTable('visitor_registry')) {
            Visitor::log();
        }

        view()->composer('*', function ($view) {
            for ($i = 1; $i <= 4; $i++) { 
                $p_cats[] = DB::table("products_categories_$i")->get();
            }

            $global_setting = json_decode(Storage::get('setting.json'));
            $currencies = trans("admin_setting.currencies");

            $view->with([
                'global_setting' => $global_setting,
            	'main_currency' => $currencies[$global_setting->main_currency],
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

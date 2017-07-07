<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\User;

use Storage;
use Session;
use Cart;
use Auth;
use DB;

class onDeliveryContoller extends Controller
{
    public function postIndex(){

    	$user = User::find(Auth::user()->id);

    	if(empty($user->country_id) || empty($user->address)){
    		Session::put('payment_address', 1);
    		$message = "You must insert your accessing Information like country & address to can use delivery payment<br><br><a href='/profile/edit-my-information'>Edit you profile now</a>";
    	} else {
    		$cart_items = json_decode(Cart::getContent()->toJson());
            $global_setting = json_decode(Storage::get('setting.json'));

	    	foreach ($cart_items as $key => $item) {
                // must in first this product supported by delivery method
                if($item->attributes->is_payment_on_delivery){

                    // add to database
                    $cart_item = new CartItem;
                    $cart_item->user_id = Auth::user()->id;
                    $cart_item->product_id = $item->id;

                    if($item->attributes->image_name != NULL)
                        $cart_item->product_image = $item->attributes->image_name;

                    $cart_item->product_name = $item->name;
                    $cart_item->product_price = $item->price - (($item->price * $item->attributes->discount_percentage) / 100);
                    $cart_item->product_currency = DB::table('currencies')->where('id', $global_setting->main_currency)->first()->title_en;
                    $cart_item->product_quantity = $item->quantity;
                    $cart_item->payment_method = "delivery";
                    $cart_item->is_payed = 0;
                    $cart_item->save();

                    // remove added product only
                    Cart::remove($item->id);
                }
	    	}

    		$message = "Your product was added successflly, wait to review it <a href='/'>back to home</a>";
    	}

    	return view("front.$this->frontendNumber.payments.delivery.status")->with("message", $message);
    }
}

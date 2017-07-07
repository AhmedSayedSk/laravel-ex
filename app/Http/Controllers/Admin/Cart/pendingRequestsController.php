<?php

namespace App\Http\Controllers\Admin\Cart;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Logic\Product\ProductRepository;

use App\Models\CartItem;
use App\Models\Product\Product;

class pendingRequestsController extends Controller
{
    public function __construct(){
        $this->middleware('admin_function:carts_controls');
    }

    public function index(){
    	$cart_products = CartItem::where('is_accepted', 0)->updates_withPaginate(5);

    	return view("back.cart.pending-requests")->with(compact(
            'cart_products'
        ));
    }

    public function accept(Request $request){
        $input = (object) $request->all();

        $cart_item = CartItem::find($input->item_id);
        $cart_item->is_accepted = 1;
        $cart_item->accepted_at_timestamps = time();
        $cart_item->save();

        Product::find($input->product_id)->update([
            'amount' => DB::raw("amount + $input->needed_quantity"),
            'sales' => DB::raw("sales - $input->needed_quantity"),
        ]);

        return back();
    }

    public function destroy($id){
    	CartItem::destroy($id);
    	return back();
    }
}
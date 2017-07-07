<?php
	/* Translation */
	$TR = "frontend.$frontendNumber.UP.CVP";
?>

@extends("front.$frontendNumber.user.master")
@section('title', trans("frontend.$frontendNumber.PT.T5"))

@section('content')
	<div id="cart-view-page">
		<div class="panel panel-default">
			<div class="panel-heading">
				<b>{{ trans("$TR.T1") }}</b>
			</div>
			<div class="panel-body">
				@if(Cart::isEmpty())
    				<div class="container-fluid empty-cart">
    					<div class="text-center">
    						<img src="./front/helper_images/empty-cart.png">
    						<h3 class="text-center">
    							<a href="/products">{{ trans("$TR.T2") }}</a>
    						</h3>
    					</div>
    				</div>
				@else
					<div class="container-fluid">
						{!! Form::open(["url"=>"/paypal-payment"]) !!}
						<?php $i = 1; ?>
						<div id="response-table">
							<table class="table table-hover table-bordered table-striped">
								<thead>
									<tr>
                                        <th></th>
										<th>{{ trans("$TR.T3") }}</th>
										<th width="20%">{{ trans("$TR.T4") }}</th>
										<th>{{ trans("$TR.T5") }}</th>
										<th>{{ trans("$TR.T6") }}</th>
										<th>{{ trans("$TR.T7") }}</th>
										<th>{{ trans("$TR.T8") }}</th>
                                        <th>delivery status</th>
										<th width="8%">{{ trans("$TR.T10") }}</th>
									</tr>
								</thead>
								<tbody>
									@foreach($cart_total_items as $item)
										<tr>
                                            <td>
                                                <input type="checkbox" name="select-item">
                                            </td>
											<td data-title='{{ trans("$TR.T3") }}'>
												@if(!is_null($item->attributes->image_name))
													<img src='{{ asset("uploaded/products/images/icon_size/".$item->attributes->image_name) }}' style="width: 80px;">
												@else
													<img src='{{ asset("assets/images/no-image.png") }}' width="80px">
												@endif
											</td>
											<td data-title='{{ trans("$TR.T4") }}'>{{ $item->name }} {{ Form::hidden("item_name_$i", $item->name) }}</td>
											<td data-title='{{ trans("$TR.T5") }}'>{{ $item->attributes->discount_percentage }}%</td>
											<td data-title='{{ trans("$TR.T6") }}'>
												{{ $item->quantity }}
												{{ Form::hidden("item_quantity_$i", $item->quantity) }}
											</span>
											</td>
											<td data-title='{{ trans("$TR.T7") }}'>
                                                @if($item->attributes->discount_percentage > 0)
												    <del>{{ number_format($item->price * DB::table('currencies')->where('title_en', $main_currency)->first()->content_refresh_to_USD) }} {{ $main_currency }}</del><br>
                                                @endif
												<span>
													{{ number_format($item->attributes->discountPrice * DB::table('currencies')->where('title_en', $main_currency)->first()->content_refresh_to_USD) }} {{ $main_currency }}
                                                    {{ Form::hidden("item_price_$i", $item->attributes->discountPrice) }}
												</span>
											</td>
											<td data-title='{{ trans("$TR.T8") }}' class="price-all-pieces" data-price="{{ $item->attributes->discountPrice * $item->quantity }}">
                                                @if($item->attributes->discount_percentage > 0)
												    <del>{{ number_format($item->price * $item->quantity * DB::table('currencies')->where('title_en', $main_currency)->first()->content_refresh_to_USD) }} {{ $main_currency }}</del><br>
                                                @endif
												<span>{{ number_format($item->attributes->discountPrice * $item->quantity * DB::table('currencies')->where('title_en', $main_currency)->first()->content_refresh_to_USD) }} {{ $main_currency }}</span>
											</td>
                                            <td data-title='delivery service' class="delivery-status" data-status="{{ $item->attributes->is_payment_on_delivery ? 'true' : 'false' }}">
                                                @if($item->attributes->is_payment_on_delivery)
                                                    yes
                                                @else
                                                    no
                                                @endif
                                            </td>
											<td class="options" data-title='{{ trans("$TR.T10") }}'>
												<?php $product_name = implode("-", explode(" ", $item->name)); ?>
												<a href="/products/{{ $item->attributes->product_serial_number }}/{{ $product_name }}">
													<span class="btn btn-default btn-xs" aria-label="Left Align" item-id="{{ $item->id }}">
														<span class="glyphicon glyphicon-eye-open text-primary" aria-hidden="true"></span>
													</span>
												</a>
                                                <span class="remove-item btn btn-default btn-xs" aria-label="Left Align" item-id="{{ $item->id }}">
                                                    <span class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span>
                                                </span>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<div class="extra">
                            <?php /*
                            <div class="total-prices">
                                <label>total prices</label>
                                <p>
                                    @foreach($total_prices as $currency_id => $price) 
                                        <b>{{ number_format($price) }} {{ trans("admin_setting.currencies")[$currency_id] }}</b><br>
                                        <?php // {{ Form::hidden("total_price", $totalPrice) }} ?>
                                    @endforeach
                                </p>
                            </div>
                            */ ?>
                            <div class="total-prices" style="display: none;">
                                <label><b>total prices:</b></label>
                                <p></p>
                                <hr>
                            </div>
                            <div class="buttons">
                                {!! Form::hidden("items_number", $itemsCount) !!}
                                <button type="submit" class="btn btn-default by-paypal-payment color">
                                    <i class="fa fa-paypal fa-2x" aria-hidden="true"></i>
                                    &nbsp; {{ trans("$TR.T12") }}
                                </button>
                                {!! Form::close() !!}

                                {!! Form::open(["url"=>"/on-delivery-payment", 'class'=>"on-delivery"]) !!}
                                    <button type="submit" class="btn btn-default on-delivery-payment disabled">
                                        <i class="fa fa-truck fa-2x" aria-hidden="true"></i>
                                        &nbsp; {{ trans("$TR.T13") }}
                                    </button>
                                {!! Form::close() !!}

                                <a href="/my-cart/clear-cart" class="btn btn-default clear-cart" style="color: #D32F2F">
                                    <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                                    &nbsp; {{ trans("$TR.T14") }}
                                </a>
                            </div>
    						<br>
							<a href="/products">{{ trans("$TR.T15") }}</a>
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>
@stop

@section('head-css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@stop

@section('footer-js')
    <script type="text/javascript">
        $(document).ready(function(){
            cartRemoveItem();

            $('.clear-cart').click(function(e){
                e.preventDefault();
                if(confirm('Are you sure to delete cart?')){
                    window.location.href = $(this).attr('href');
                }
            });
        });
    </script>

    <script type="text/javascript" data-des="payment checkbox">
        $(document).ready(function(){
            function getPaymentStatus1(_this){
                var delivery_status = _this.parents('tr').find('.delivery-status').attr('data-status');
                //var paypal_status = _this.parents('tr').find('.paypal-status').attr('data-status');

                delivery_status = $.parseJSON(delivery_status);
                //paypal_status = $.parseJSON(paypal_status);

                if(delivery_status) {
                    $('.on-delivery-payment').removeClass('disabled').addClass('color');
                }

                /*if(paypal_status) {
                    $('.by-paypal-payment').removeClass('disabled').addClass('color');
                }*/
            }

            function getPaymentStatus2(_this){
                var delivery_status = _this.parents('tr').find('.delivery-status').attr('data-status');
                //var paypal_status = _this.parents('tr').find('.paypal-status').attr('data-status');

                delivery_status = $.parseJSON(delivery_status);
                //paypal_status = $.parseJSON(paypal_status);

                if(delivery_status != true) {
                    $('.on-delivery-payment').addClass('disabled').removeClass('color');
                }

                /*if(paypal_status != true) {
                    $('.by-paypal-payment').addClass('disabled').removeClass('color');
                }*/
            }

            $('input[name="select-item"]').change(function(){
                var _this = $(this);

                // parseJSON to change string to boolean value
                var item_checked_status = $.parseJSON(_this.is(':checked'));

                // check if is true and get values of current selector
                if(item_checked_status) {
                    getPaymentStatus1(_this);
                } else {
                    $('.on-delivery-payment').addClass('disabled').removeClass('color');

                    // loop on all checkboxes at else state to check for checked box and applay same function
                    $('input[name="select-item"]').each(function(){
                        var _this = $(this);

                        if(_this.is(':checked')){
                            getPaymentStatus1(_this);
                        }
                    });
                }

                var selectItem = [];

                $('input[name="select-item"]').each(function(index){
                    var _this = $(this);

                    if(_this.is(':checked')){
                        getPaymentStatus2(_this);
                        selectItem[index] = 1;
                    }else {
                        selectItem[index] = 0;
                    }
                });



                if(jQuery.inArray(1, selectItem) !== -1){
                    $('.total-prices').slideDown(200);
                   
                    var itemsPricesAndCurrency = [];

                    $('input[name="select-item"]').each(function(index){
                        var _this = $(this);
                        
                        if(_this.is(':checked')){
                            var all_pieces_price = _this.parents('tr').find('.price-all-pieces').attr('data-price').toString();
                            var currency = $.trim("{{ $main_currency }}");

                            itemsPricesAndCurrency[index] = {
                                "currency": currency,
                                "price": Math.round(all_pieces_price)
                            };
                        }
                    });

                    // to sum all price of it currency separately
                    var default_a = {};
                    var itemsPricesAndCurrency2 = itemsPricesAndCurrency.reduce(function(r, e) {
                        var key = e.currency;
                        if (!default_a[key]) {
                            default_a[key] = e;
                            r.push(default_a[key]);
                        } else {
                            default_a[key].price = parseFloat(default_a[key].price);
                            default_a[key].price += parseFloat(e.price);
                        }
                        return r;
                    }, []);

                    var total_prices_content = "";

                    $.each(itemsPricesAndCurrency2, function(key, value){
                        total_prices_content += addCommas(value.price) + " " + value.currency + "<br>";
                    });

                    $('.total-prices p').html(total_prices_content.slice(0, -4));

                } else {
                    $('.total-prices').slideUp(200);
                }

            })
        });
    </script>
@stop

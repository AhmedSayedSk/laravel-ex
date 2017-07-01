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
										<th>{{ trans("$TR.T3") }}</th>
										<th width="20%">{{ trans("$TR.T4") }}</th>
										<th>{{ trans("$TR.T5") }}</th>
										<th>{{ trans("$TR.T6") }}</th>
										<th>{{ trans("$TR.T7") }}</th>
										<th>{{ trans("$TR.T8") }}</th>
										<th>{{ trans("$TR.T9") }}</th>
										<th>{{ trans("$TR.T10") }}</th>
									</tr>
								</thead>
								<tbody>
									@foreach($cart_total_items as $item)
										<tr>
											<td data-title='{{ trans("$TR.T3") }}'>
												@if(!is_null($item->attributes->image_name))
													<img src='{{ asset("uploaded/products/images/icon_size/".$item->attributes->image_name) }}' style="max-width: 80px;">
												@else
													<img src='{{ asset("assets/images/no-image.png") }}' width="120px">
												@endif
											</td>
											<td data-title='{{ trans("$TR.T4") }}'>{{ $item->name }} {{ Form::hidden("item_name_$i", $item->name) }}</td>
											<td data-title='{{ trans("$TR.T5") }}'>{{ $item->attributes->discount_percentage }}</td>
											<td data-title='{{ trans("$TR.T6") }}'>
												{{ $item->quantity }}
												{{ Form::hidden("item_quantity_$i", $item->quantity) }}
											</span>
											</td>
											<td data-title='{{ trans("$TR.T7") }}'>
												<del>{{ number_format($item->price) }}</del><br>
												<span>
													{{ number_format($item->attributes->discountPrice) }}
													{{ Form::hidden("item_price_$i", $item->attributes->discountPrice) }}
												</span>
											</td>
											<td data-title='{{ trans("$TR.T8") }}'>
												<del>{{ number_format($item->price * $item->quantity) }}</del><br>
												<span>{{ number_format($item->attributes->discountPrice * $item->quantity) }}</span>
											</td>
											<td data-title='{{ trans("$TR.T9") }}'>
												{{ trans("admin_setting.currencies")[$item->attributes->currency_id - 1] }}
											</td>
											<td class="options" data-title='{{ trans("$TR.T10") }}'>
												<span class="remove-item btn btn-default btn-xs" aria-label="Left Align" item-id="{{ $item->id }}">
													<span class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span>
												</span>
												<?php $product_name = implode("-", explode(" ", $item->name)); ?>
												<a href="/products/{{ $item->attributes->product_serial_number }}/{{ $product_name }}">
													<span class="btn btn-default btn-xs" aria-label="Left Align" item-id="{{ $item->id }}">
														<span class="glyphicon glyphicon-eye-open text-primary" aria-hidden="true"></span>
													</span>
												</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<div class="extra">
                            <div class="total-prices">
                                <label>total prices</label>
                                <p>
                                    @foreach($total_prices as $currency_id => $price) 
                                        <b>{{ number_format($price) }} {{ trans("admin_setting.currencies")[$currency_id - 1] }}</b><br>
                                        <?php // {{ Form::hidden("total_price", $totalPrice) }} ?>
                                    @endforeach
                                </p>
                            </div>
                            <hr>
                            <div class="buttons">
                                {!! Form::hidden("items_number", $itemsCount) !!}
                                {!! Form::submit(trans("$TR.T12"), ["class"=>"btn btn-default"]) !!}
                                {!! Form::close() !!}

                                {!! Form::open(["url"=>"/on-delivery-payment", 'class'=>"on-delivery"]) !!}
                                    {!! Form::submit(trans("$TR.T13"), ["class"=>"btn btn-default on-delivery-payment"]) !!}
                                {!! Form::close() !!}

                                <a href="/my-cart/clear-cart" class="btn btn-default clear-cart">
                                    <span class="text-danger">{{ trans("$TR.T14") }}</span>
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
@stop

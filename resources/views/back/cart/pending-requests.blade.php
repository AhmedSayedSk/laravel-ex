<?php
	/* Translation */
	$TR = "admin_panel.ACVPIP";
?>

@extends("back.master")
@section('title', trans("admin_panel.APT.T8"))

@section("content")
	<div id="cart-view-page">
		<div class="panel panel-default">
			<div class="panel-heading">
				{{ trans("$TR.T1") }} - {!! trans("$TR.T4") !!}
			</div>
			<div class="panel-body">
				@if(count($cart_products) == 0)
					<h3 class="text-center">
						{{ trans("$TR.T2") }}
						<a href="/admin/products">{{ trans("$TR.T3") }}</a>
					</h3>
				@else
					<div class="container-fluid">
						<div id="response-table">
							<table class="table table-striped table-bordered ps-view">
								<thead>
									<tr>
										<th>{{ trans("$TR.T5") }}</th>
										<th width="20%">{{ trans("$TR.T6") }}</th>
										<th>{{ trans("$TR.T7") }}</th>
                                        <th>requested quantity</th>
										<th>current amount</th>
										<th>{{ trans("$TR.T9") }}</th>
										<th>{{ trans("$TR.T10") }}</th>
										<th>{{ trans("$TR.T12") }}</th>
									</tr>
								</thead>
								<tbody>
									@foreach($cart_products as $product)
										<tr>
											<td data-title='{{ trans("$TR.T5") }}'>
                                                @if(!is_null($product->product_image))
                                                    <img src='{{ asset("uploaded/products/images/icon_size/$product->product_image") }}' width="80px">
                                                @else
                                                    <img src='{{ asset("assets/images/no-image.png") }}' width="80px">
                                                @endif
											</td>
											<td data-title='{{ trans("$TR.T6") }}' width="10%">{{ $product->product_name }}</td>
											<td data-title='{{ trans("$TR.T7") }}'>{{ number_format($product->product_price * DB::table('currencies')->where('title_en', $main_currency)->first()->content_refresh_to_USD) }} {{ $product->product_currency }}</td>
											<td data-title='{{ trans("$TR.T8") }}'>{{ $product->product_quantity }}</td>
											<td data-title='{{ trans("$TR.T9") }}'>{{ $product->current_amount }}</td>
											<td data-title='{{ trans("$TR.T10") }}'>{{ $product->payment_method }}</td>
                                            <td data-title='{{ trans("$TR.T11") }}'>{{ $product->created_at }}</td>
											<td data-title='{{ trans("$TR.T12") }}' width="12%">
												{!! Form::open(["url"=>"/admin/review-cart/pending-requests/accept"]) !!}
													{!! Form::hidden('item_id', $product->id) !!}
													{!! Form::hidden('product_id', $product->product_id) !!}
													{!! Form::hidden('needed_quantity', $product->product_quantity) !!}
													<button type="submit" class="btn btn-primary btn-xs">{{ trans("$TR.T13") }}</button>
												{!! Form::close() !!}
												{!! Form::open(["url"=>"/admin/review-cart/pending-requests/$product->id", "method"=>"DELETE"]) !!}
													<button type="submit" class="btn btn-danger btn-xs" aria-label="Left Align">
														<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
													</button>
												{!! Form::close() !!}
											</td>
										</tr>
									@endforeach				
								</tbody>
							</table>
						</div>
					</div>
				@endif
			</div>
			<div class="text-center">
				{!! $cart_products->render() !!}
			</div>
		</div>
	</div>		
@stop
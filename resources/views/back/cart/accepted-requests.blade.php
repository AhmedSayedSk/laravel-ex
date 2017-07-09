<?php
	/* Translation */
	$TR = "admin_panel.ACVAIP";
?>

@extends("back.master")
@section('title', trans("admin_panel.APT.T7"))

@section("content")
	<div id="cart-view-page">
        @include('includes.flash-message')
        @include('includes.back-error')
        
		<div class="panel panel-default">
			<div class="panel-heading">
				{{ trans("$TR.T1") }} - {!! trans("$TR.T4") !!}
			</div>
			<div class="panel-body">
				@if(count($cart_items) == 0)
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
										<th>{{ trans("$TR.T6") }}</th>
										<th>{{ trans("$TR.T7") }}</th>
										<th>{{ trans("$TR.T8") }}</th>
										<th>{{ trans("$TR.T9") }}</th>
										<th>{{ trans("$TR.T10") }}</th>
                                        <th>{{ trans("$TR.T11") }}</th>
										<th>options</th>
									</tr>
								</thead>
								<tbody>
									@foreach($cart_items as $item)
										<tr>
											<td data-title='{{ trans("$TR.T5") }}'>
												@if(!is_null($item->product_image))
                                                    <img src='{{ asset("uploaded/products/images/icon_size/$item->product_image") }}' height="80px">
                                                @else
                                                    <img src='{{ asset("assets/images/no-image.png") }}' width="80px">
                                                @endif
											</td>
											<td data-title='{{ trans("$TR.T6") }}'>{{ $item->product_name }}</td>
											<td data-title='{{ trans("$TR.T7") }}'>{{ $item->product_price }} {{ $item->product_currency }}</td>
											<td data-title='{{ trans("$TR.T8") }}'>{{ $item->product_quantity }}</td>
											<td data-title='{{ trans("$TR.T9") }}'>{{ $item->payment_method }}</td>
											<td data-title='{{ trans("$TR.T10") }}'>{{ $item->created_at }}</td>
											<td data-title='{{ trans("$TR.T11") }}'>{{ date("d/m/Y", $item->accepted_at_timestamps) }}</td>
										    <td>
                                                {!! Form::open(["url"=>"/admin/review-cart/accepting-requests/pay"]) !!}
                                                    {!! Form::hidden('item_id', $item->id) !!}
                                                    <button type="submit" class="btn btn-{{ $item->is_payed ? 'success disabled' : 'default' }} btn-sm">payed</button>
                                                {!! Form::close() !!}
                                                @if(!$item->is_payed)
                                                    {!! Form::open(["url"=>"/admin/review-cart/accepting-requests/$item->id", "method"=>"DELETE"]) !!}
                                                        <button type="submit" class="btn btn-danger btn-sm" aria-label="Left Align">cancel request</button>
                                                    {!! Form::close() !!}
                                                @endif
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
				{!! $cart_items->render() !!}
			</div>
		</div>
	</div>
@stop
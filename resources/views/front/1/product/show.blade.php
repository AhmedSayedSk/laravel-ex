<?php
	// to stop refer to show product page after login
	if(Auth::check()){
		Session::forget('referedToProduct');
	}

	/* Translation */
	$TR = "frontend.$frontendNumber.PS1";
?>

@extends("front.$frontendNumber.master")
@section('title', $product->name)

@section('content')
	<div id="product-show" class="container-fluid">
		<div class="row">
			<div class="col-md-{{ count($product->images) > 0 ? '7' : '12'}}">
				<div id="product-panel" class="panel panel-default">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-12 vcenter">
								<p class="p-name">
									{{ $product->name }}
								</p>
								<span class="p-price">
									<b class="text-success">{{ $product->discountPrice }} {{ trans("admin_setting.currencies")[$product->currency_id - 1] }}</b>
									@if($product->discount_percentage > 0)
										<span class="text-danger">{{ trans("$TR.T1", ["discount"=>$product->discount_percentage]) }}</span>
									@endif
								</span>
                                <div class="right-section" product-id="{{ $product->id }}" serial-number="{{ $product->serial_number }}">
                                    <button class="btn btn-default add-to-cart">{{ trans("$TR.T2") }}</button>
                                </div>
							</div>
						</div>
					</div>
					<div class="panel-body">
						@if(Auth::check())
							@if($personType == "super_admin" || $personType == "admin")
								<a href="{{ route('admin.products..show', $product->id) }}" class="btn btn-default">{{ trans("$TR.T3") }}</a>
								<hr>
							@endif
						@endif
						<table class="table table-striped table-bordered">
							<tr>
								<td>{{ trans("$TR.T4") }}</td>
								<td>{!! $product->categories_list !!}</td>
							</tr>
							<tr>
								<td>{{ trans("$TR.T5") }}</td>
								<td>
									@for($i = 1; $i <= $product->stars; $i++)
										<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									@endfor
								</td>
							</tr>
							<tr>
								<td>{{ trans("$TR.T6") }}</td>
								<td>{{ $product->view_counter }}</td>
							</tr>
							<tr>
								<td>{{ trans("$TR.T7") }}</td>
								<td>{{ $product->payment_on_delivery }}</td>
							</tr>
							<tr>
								<td>{{ trans("$TR.T8") }}</td>
								<td>{{ $product->payment_by_paypal }}</td>
							</tr>
							<tr>
								<td>{{ trans("$TR.T9") }}</td>
								<td>
									@if(count($products_tags) > 0)
										@foreach($products_tags as $tag)
											<a href="/products/search/tag/{{ $tag }}" class="tag-btn">{{ $tag }}</a>
										@endforeach
									@else
										<span class="text-warning">{{ trans("$TR.T10") }}</span>
									@endif
								</td>
							</tr>
						</table>
						<div class="lead">{{ trans("$TR.T11") }}</div>
						{{ $product->description }}
					</div>
				</div>
			</div>
            @if(count($product->images) > 0)
    			<div class="col-md-5 p-images">
    				@include("front.$frontendNumber.product.add-ons.carousel")
    			</div>
            @endif
		</div>
	</div>
@stop

@section('footer-js')
    <script type="text/javascript">
        $(document).ready(function(){
            //toggle_edit_section();
            product_addToCart([
                'you need to login first, Login now?',
                'The request was cancelled',
                "Detect product quantity"
            ]);
        })
    </script>
@stop

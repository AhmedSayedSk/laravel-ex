<?php
	/* Translation */
	$TR = "frontend.$frontendNumber.add-ons.PS1";
?>

<div class="row">
	@foreach($products as $product)
		<div class="item">
			<div class="panel" product-id="{{ $product->id }}" serial-number="{{ $product->serial_number }}">
				@if($product->is_new)
					<div class="edge-corner">
						<img src="front/helper_images/new-corner.png">
					</div>
				@endif
				<div class="panel-body">
					<a href='/products/{{ $product->serial_number }}/{{ $product_name = implode("-", explode(" ", $product->name)) }}'>
						@if(!is_null($product->image_name))
							<img src='{{ asset("uploaded/products/images/icon_size/$product->image_name") }}'>
						@else
							<img src='{{ asset("assets/images/no-image.png") }}'>
						@endif
					</a>
				</div>
				<div class="panel-footer">
					<p class="p-name">{{ $product->name }}</p>
					<p class="p-price">
						@if($product->discount_percentage > 0)
							<del>{{ $product->price }} {{ trans("admin_setting.currencies")[$product->currency_id - 1] }}</del>
							&nbsp;
						@endif
						<b class="text-success">{{ $product->discountPrice }} {{ trans("admin_setting.currencies")[$product->currency_id - 1] }}</b>
					</p>
					<p class="p-sales">{{ trans("$TR.T1") }} {{ $product->sales }}</p>
					<p class="p-amount">{{ trans("$TR.T4") }} {{ $product->amount }}</p>
					<div class="options">
						<div class="add-to-cart">
							<button class="btn btn-link" title="{{ trans("$TR.T3") }}" aria-hidden="true" data-toggle="tooltip" data-placement="top">
								<span class="glyphicon glyphicon-shopping-cart"></span>
							</button>
						</div>
						<div class="product-details">
							<a class="btn btn-link" href='/products/{{ $product->serial_number }}/{{ $product_name }}'>
								{{ trans("$TR.T2") }}
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endforeach
</div>

<script type="text/javascript">
	$(document).ready(function(){
		product_addToCart([
			'you need to login first, Login now?',
			'The request was cancelled',
			'Detect product quantity'
		]);
	});
</script>

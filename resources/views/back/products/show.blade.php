<?php
	/* Translation */
	$TR = "admin_panel.APSP";
?>

@extends('back.master')
@section('title', trans("admin_panel.APT.T14", ['name' => $product->name]))

@section('content')
	<div id="product-show-page">
		@include('includes.flash-message')

		<div class="panel panel-default">
			<div class="panel-heading">
				<span class="product-name">{{ $product->name }}</span>
				<a href="{{ route('admin.products..edit', $product->id) }}" class="btn btn-default btn-sm pull-right" title='{{ trans("$TR.T1") }}'>
					edit &nbsp;
					<span class="glyphicon glyphicon-pencil"></span>
				</a>
				@include('standers.add-ons.live-status-btn')
				@include('standers.add-ons.carousel-status-btn')
				@include('standers.add-ons.new-product-status-btn')
			</div>
			<div class="panel-body">
				<div class="images">
					<h3>{{ trans("$TR.T3") }}</h3>
					<div id="zoomwall1" class="zoomwall images">
						@if(count($product->images) > 0)
							@foreach($product->images as $image)
								<img class="image-context" src='{{ asset("uploaded/products/images/full_size/$image") }}' data-name="{{ $image }}">
							@endforeach
						@else
							<img src='{{ asset("assets/images/no-image.png") }}'>
						@endif
					</div>
				</div>
                <div class="carousel">
                    <h3>{{ trans("$TR.T2") }}</h3>
                    <div id="zoomwall2" class="zoomwall carousels">
                        @if(count($product->carousels) > 0)
                            @foreach($product->carousels as $carousel)
                                <img class="carousel-context" src='{{ asset("uploaded/products/carousel_gallery/small/$carousel") }}' data-name="{{ $carousel }}">
                            @endforeach
                        @else
                            <img src='{{ asset("assets/images/no-image.png") }}'>
                        @endif
                    </div>
                </div>
				<hr>
				<div class="info">
					<h3>{{ trans("$TR.T4") }}</h3>
					<p><b>{{ trans("$TR.T5") }}</b>: {{ $product->name }}</p>
					<p><b>{{ trans("$TR.T6") }}</b>: {{ $product->description }}</p>
					<p><b>{{ trans("$TR.T7") }}</b>: {{ number_format($product->discountPrice * DB::table('currencies')->where('title_en', $main_currency)->first()->content_refresh_to_USD) }} {{ $main_currency }}</p>
					<p><b>{{ trans("$TR.T8") }}</b>: {{ $product->amount }}</p>
					<p><b>{{ trans("$TR.T9") }}</b>: {{ $product->sales }}</p>
					<p><b>{{ trans("$TR.T10") }}</b>: <br>{!! $product->categories_list !!}</p>
					<p><b>{{ trans("$TR.T11") }}</b>: {{ $product->created_at }} <span class="rent-time">({{ $product->created_at->diffForHumans() }})</span></p>
					<p><b>{{ trans("$TR.T11_5") }}</b>: {{ $product->updated_at }} <span class="rent-time">({{ $product->updated_at->diffForHumans() }})</span></p>
					<p><b>{{ trans("$TR.T12") }}</b>: {{ $product->payment_on_delivery }}</p>
					<p><b>{{ trans("$TR.T13") }}</b>: {{ $product->payment_by_paypal }}</p>
					<p><b>{{ trans("$TR.T14") }}</b>: {{ $product->view_counter }}</p>
					<p class="tags">
						<b>{{ trans("$TR.T15") }}</b>:
						@if(count($products_tags) > 0) 
							@foreach($products_tags as $tag)
								<a href="/admin/products/tags/{{ $tag }}">{{ $tag }}</a>
							@endforeach
						@else
							{{ trans("$TR.T16") }}
						@endif
					</p>
				</div>
			</div>
		</div>
	</div>
@stop


@section('head-css')
	<link rel="stylesheet" type="text/css" href="./packages/zoomwall.js/zoomwall.css">
@stop

@section('head-js')
	<script type="text/javascript" src="./packages/zoomwall.js/zoomwall.js"></script>
	<script>
		window.onload = function() {
			zoomwall.create(document.getElementById('zoomwall1'), true);
			zoomwall.create(document.getElementById('zoomwall2'), true);
		};
	</script>
@stop
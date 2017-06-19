<?php
	/* Translation */
	$TR = "admin_panel.ACPP";
?>

@extends('back.master')
@section('title', trans("admin_panel.APT.T3", ['number'=>1]))

@section('content')

	<div id="product-create-page">
		@include('includes.flash-message')
		@include('includes.back-error')

		<div id="warning-alert" class="alert alert-warning alert-dismissible" role="alert" style="display: none">
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  	<span class="glyphicon glyphicon-info-sign"></span>
		  	<span class="body"></span>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<b>{{ trans("$TR.T1", ['number'=>'I']) }}</b>
			</div>
			<div class="panel-body">
				<div class="container-fluid tabs-wrap">
				    <div class="draggable-container">
					    <ul class="nav nav-tabs draggable" role="tablist">
					        <li class="active">
					        	<a href="#literal-data" aria-controls="literal-data" aria-expanded="true" role="tab" data-toggle="tab">
					        		<span class="icon-fontello-n1"></span>
					        		{{ trans("$TR.T2") }}
					        	</a>
					        </li>
					        <li>
					        	<a href="#categories" aria-controls="categories" aria-expanded="true" role="tab" data-toggle="tab">
					        		<span class="icon-fontello-n2"></span>
					        		{{ trans("$TR.T3") }}
					        	</a>
					        </li>
					        <li>
					        	<a href="#numerical-data" aria-controls="numerical-data" aria-expanded="true" role="tab" data-toggle="tab">
					        		<span class="icon-fontello-n3"></span>
					        		{{ trans("$TR.T4") }}
					        	</a>
					        </li>
					    </ul>
				    </div>
				    <div id="create-product">	
					    {!! Form::open(["url"=>route("admin.products..store")."/store/step/1", "files"=>"true"]) !!}
						    <div class="tab-content">
						        <div class="tab-pane active" id="literal-data">
						        	<div class="form-group">
										{!! Form::label("productName", trans("$TR.T5")) !!}
										<span class="text-danger">*</span>
										{!! Form::text("product_name", "", ["class"=>"form-control input-xlg", "id"=>"productName", "dir"=>"auto"]) !!}
										<span class="help-block opc-7">{{ trans("sub_validation.register.T4") }}</span>
									</div>
									<div class="form-group">
										{!! Form::label("productDetails", trans("$TR.T7")) !!}
										<span class="text-danger">*</span>
										{!! Form::textarea("product_description", "", ["class"=>"form-control input-lg", "id"=>"productDetails", "dir"=>"auto"]) !!}
										<span class="help-block opc-7">{{ trans("sub_validation.register.T1") }}</span>
									</div>
									<div class="form-group serial-number">
										{!! Form::label("serialNumber", trans("$TR.T9")) !!}										
										<div class="input-group">
											{!! Form::text("serial_number", "", ["class"=>"form-control serial-number", "id"=>"serialNumber"]) !!}
										    <span class="input-group-addon">
										    	<a href="#" class="generate">generate</a>
										    </span>
										</div>
										<span class="help-block opc-7">Help for identify and target the product in search engines</span>
									</div>
									<button class="btn btn-default continue" type="button">{{ trans("$TR.T10") }} <span class="icomoon-arrow-10"></span></button>
						        </div>
						        <div class="tab-pane categories" id="categories" data-max-categories="4">
						        	<div class="form-group categories">
						        		<label>[<a href="/admin/products/categories" target="_blank">{{ trans("$TR.T11") }}</a>]</label>
										<span class="text-danger">*</span>
										<select name="p_cat1" class="form-control p-cat" data-table-num="1">
											<option value="0" selected>{{ trans("$TR.T12") }}</option>
											@foreach($p_cat1 as $key=>$cat)
												<option value="{{$key}}">{{$cat}}</option>
											@endforeach
										</select>
										{!! Form::select("p_cat2", [], 0, ["class"=>"form-control p-cat", "data-table-num"=>"2"]) !!}
										{!! Form::select("p_cat3", [], 0, ["class"=>"form-control p-cat", "data-table-num"=>"3"]) !!}
										{!! Form::select("p_cat4", [], 0, ["class"=>"form-control p-cat", "data-table-num"=>"4"]) !!}
										
										{!! Form::hidden("category_id", 0, ["class"=>"category-id"]) !!}
										{!! Form::hidden("category_table_number", 0, ["class"=>"cat-table-number"]) !!}
						        	</div>
						        	<button type="button" class="btn btn-default back">
						        		<span class="icomoon-arrow-10 flipped col-flip-180"></span> 
						        		{{ trans("$TR.T13") }}
						        	</button>
					    			<button type="button" class="btn btn-default continue">
					    				{{ trans("$TR.T14") }} 
					    				<span class="icomoon-arrow-10"></span>
					    			</button>
						        </div>
						        <div class="tab-pane" id="numerical-data">
						        	<div class="row">
						        		<div class="col-md-5">
						        			<div class="form-group">
												{!! Form::label("productPrice", trans("$TR.T15")) !!}
												<span class="text-danger">*</span>
												<div class="input-group">
													{!! Form::text("product_price", "0.00", ["class"=>"form-control price input-xlg", "id"=>"productPrice", "aria-label"=>trans("$TR.T16"), "style"=>"color: green"]) !!}
													<snap class="input-group-addon">
														{{ $main_currency }} <br>
														<a href="/admin/site-setting">(change)</a>
													</snap>
												</div>				
											</div>
						        		</div>							        		
						        		<div class="col-md-3">
						        			<div class="form-group">
												{!! Form::label("priceDiscount", trans("$TR.T17")) !!}
												<div class="input-group">
											      {!! Form::text("discount_percentage", "", ["class"=>"form-control discount-percentage input-xlg", "id"=>"priceDiscount", "maxlength"=>"3", "style"=>"color: #EF6C00"]) !!}
											      <snap class="input-group-addon">%</snap>
											    </div>
											</div>
						        		</div>
						        		<div class="col-md-4">
						        			<div class="form-group">
												{!! Form::label("discountedPrice", trans("$TR.T47")) !!}
											    {!! Form::text("", "0.00", ["class"=>"form-control discounted-price input-xlg", "id"=>"discountedPrice"]) !!}
											</div>
						        		</div>					
						        	</div>							        	
									<div class="form-group product-amount">
										{!! Form::label("productAmount", trans("$TR.T18")) !!}
										{!! Form::number("product_amount", "", ["class"=>"form-control", "id"=>"productAmountText"]) !!}
										<div class="checkbox">
											<label>
												{!! Form::hidden("is_amount_unlimited", 0) !!}
												{!! Form::checkbox("is_amount_unlimited", 1, "checked", ["class"=>"checkbox", "id"=>"productAmountStatus"]) !!}
												<span>{{ trans("$TR.T19") }}</span>
											</label>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-md-5">
											<div class="form-group start-at">
												{!! Form::label("startAtData", trans("$TR.T20")) !!}
												{!! Form::date("start_at", "", ["class"=>"form-control", "id"=>"startAtData"]) !!}
												<div class="checkbox">
													<label>
														{!! Form::hidden("is_start_view_now", 0) !!}
														{!! Form::checkbox("is_start_view_now", 1, "checked", ["class"=>"checkbox", "id"=>"startAtStatus"]) !!}
														<span>{{ trans("$TR.T21") }}</span>
													</label>
												</div>				
											</div>	
										</div>
										<div class="col-md-7">
											<div class="form-group expires-condition">
												<label>expires_condition</label>
												<div class="radio">
													<label>
														{!! Form::radio("expires_condition", "expires_at", null, ["class"=>"checkbox"]) !!}
														<span>expire viewing at</span>
													</label>
												</div>
												{!! Form::date("expires_at", "", ["class"=>"form-control expires-at", "disabled"=>"disabled"]) !!}
												<div class="radio">
													<label>
														{!! Form::radio("expires_condition", "by_days", null, ["class"=>"checkbox"]) !!}
														<span>{!! trans("$TR.H23", ['inputClass'=>'wid-100 expires-days', 'inputName'=>'expires_days', 'today' => date("d/m/Y", time()), "disabled"=>"disabled"]) !!}</span>
													</label>
												</div>
												<div class="radio">
													<label>
														{!! Form::radio("expires_condition", "unlimited_expires", "checked", ["class"=>"checkbox"]) !!}
														<span>{{ trans("$TR.T24") }}</span>
													</label>
												</div>
											</div>
										</div>
									</div>
											
									<button type="button" class="btn btn-default back"><span class="icomoon-arrow-10 flipped col-flip-180"></span> {{ trans("$TR.T13") }}</button>
					    			<button type="submit" class="btn btn-default continue">{{ trans("$TR.T25") }} <span class="icomoon-arrow-10"></span></button>
						        </div>
						    </div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			var categories_id = [];

			optimizeCategories();

			enable_disable_input($("#productAmountStatus"), $("#productAmountText"));
			enable_disable_input($("#startAtStatus"), $("#startAtData"));

			$("#create-product .form-group.expires-condition :radio").on("change", function(){
				var current_value = $(this).val();

				$(this).parents(".form-group").find(":input:not(:radio)").attr("disabled", "disabled");

				switch(current_value){
					case "expires_at":
						$(this).parents('.form-group').find(":input.expires-at").removeAttr("disabled");
					break;
					case "by_days":
						$(this).parents('.form-group').find(":input.expires-days").removeAttr("disabled");
					break;
					default:
						return false;
				}
			});
			
			$('#create-product .serial-number a.generate').on("click", function(e){
				var _this = $(this);
				e.preventDefault();
				$.ajax({
					url: "/admin/products/create/generate-serial-number",
					type: "post",
					success: function(result){
						_this.parents('.form-group.serial-number').find("input.serial-number").val(result);
					}
				})
			});

			$('#create-product input.price').priceFormat({
				prefix: ""
			});

			$("#create-product .price, #create-product .discount-percentage").on("keyup change", function(){
				var result;
				var price = $("#create-product .price").unmask() / 100;
				var discount = $("#create-product .discount-percentage").val() || 0;

				if(discount != 0){
					result = price - (price * (discount/100));
					result = result.toFixed(2);
				} else {
					result = price;
					result = result.toFixed(2);
				}

				$("#create-product .discounted-price").val(result);
				$("#create-product .discounted-price").priceFormat({
					prefix: ""
				});
			});

			$("#create-product .discounted-price").on("keyup", function(){
				var discount;
				var discountedPrice = $(this).unmask() / 100;
				var price = $("#create-product .price").unmask() / 100;

				if(price > 0){
					if(discountedPrice < price){
						discount = 100 * ( 1 - (discountedPrice/price));
						discount = discount.toFixed(2);
						$("#create-product .discount-percentage").val(discount);
						$("#warning-alert").slideUp(300);
					} else {
						$("#warning-alert").slideDown(300).find(".body").html("<b>Warning !!</b>, Current price is less than discounted price!");
					}
				}
			});

			/* ------------- */

			$('.tab-pane .continue').click(function(){
			  $('.nav-tabs > .active').next('li').find('a').trigger('click');
			});

			$('.tab-pane .back').click(function(){
			  $('.nav-tabs > .active').prev('li').find('a').trigger('click');
			});

			/* -------------- */

			$("select[name^='p_cat']").focus(function(index){
				var related_id = 0;

				var $select = $(this);
				var table_number = $select.attr('data-table-num');
				var parameters_count = $select.find('option').length - 1;

				if(table_number > 1) {
					var current_target = table_number - 1;
					related_id = $("select[name='p_cat"+current_target+"']").val();
					console.log(related_id);
				}

				$.ajax({
					url: "/admin/products/categories/refresh-parameters",
					type: "post",
					data: {
						related_id: related_id,
						category_table_number: $select.attr('data-table-num'),
						parameters_count: parameters_count
					},
					success: function(new_parameters){
						if(new_parameters != 0) {
							$select
								.find('option')
								.remove();

							$select
								.append('<option value="0">{{ trans("$TR.T12") }}</option>');

							$.each(new_parameters, function(key, value){
							    $select.append('<option value=' + key + '>' + value + '</option>');
							});
						}	
					}
				})
			});		
		})
	</script>

@stop

@section('head-css')
	<link rel="stylesheet" type="text/css" href="./assets/css/packages/fontello/numbers/css/fontello.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/packages/icomoon/arrows/style.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/packages/draggable-taps/draggable-taps.css">
@stop

@section('footer-js')
	<script type="text/javascript" src="./assets/js/jquery-ui/widget.js"></script>
	<script type="text/javascript" src="./assets/js/jquery-ui/mouse.js"></script>
	<script type="text/javascript" src="./assets/js/jquery-ui/data.js"></script>
	<script type="text/javascript" src="./assets/js/jquery-ui/plugin.js"></script>
	<script type="text/javascript" src="./assets/js/jquery-ui/safe-active-element.js"></script>
	<script type="text/javascript" src="./assets/js/jquery-ui/safe-blur.js"></script>
	<script type="text/javascript" src="./assets/js/jquery-ui/scroll-parent.js"></script>
	<script type="text/javascript" src="./assets/js/jquery-ui/widgets/draggable.min.js"></script>
	<script type="text/javascript" src="./assets/js/draggable-taps.min.js"></script>
	<script type="text/javascript" src="./packages/Jquery-Price-Format/jquery.priceformat.min.js"></script>
@stop
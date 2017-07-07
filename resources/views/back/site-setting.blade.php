<?php
	/* Translation */
	$TR = "admin_panel.ASSP";
?>

@extends('back.master')
@section('title', trans('admin_panel.APT.T14'))

@section('content')
	<div id="site-setting-page">
		@include('includes.back-error')
		@include('includes.flash-message')

		<div class="panel panel-default">
			<div class="panel-heading">{{ trans("$TR.T1") }}</div>
			<div class="panel-body">
				{!! Form::open(["url"=>"/admin/site-setting"]) !!}
                    <div class="main-setting">
    					<p class="base-title"><u>{{ trans("$TR.T7") }}</u></p>
                        <div class="primary">
        					<div class="row">
        						<div class="item">
        							<div class="form-group">
        								{!! Form::label("", trans("$TR.T2")) !!}
        								{!! Form::text("site_name", $site_setting->site_name, ["class"=>"form-control"]) !!}
        							</div>
        						</div>
        						<div class="item">
        							<div class="form-group">
        								{!! Form::label("", trans("$TR.T3")) !!}
        								{!! Form::text("site_category", $site_setting->site_category, ["class"=>"form-control"]) !!}
        							</div>
        						</div>
        						<div class="item">
        							<div class="form-group">
        								{!! Form::label("", trans("$TR.T5")) !!}
        								{!! Form::text("customer_service_number", $site_setting->customer_service_number, ["class"=>"form-control"]) !!}
        							</div>
        						</div>
                                <div class="item">
                                    <div class="form-group">
                                        {!! Form::label("", trans("$TR.T5")) !!}
                                        {!! Form::number("currencies_auto_update_duration", $site_setting->currencies_auto_update->duration, ["class"=>"form-control"]) !!}
                                        <div class="help-block">by minutes</div>
                                    </div>
                                </div>
        					</div>
                        </div>
                    </div>
					
                    <div class="product-setting">
                        <p class="base-title"><u>{{ trans("$TR.T8") }}</u></p>
                        <div class="primary">
                            <div class="row">
                                <div class="item">
                                    <div class="form-group">
                                        {!! Form::label("", trans("$TR.T4")) !!}
                                        {!! Form::select("main_currency", $currencies, $site_setting->main_currency, ["class"=>"form-control"]) !!}
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="form-group">
                                        {!! Form::label("", trans("$TR.T9")) !!}
                                        {!! Form::select("newStatusTimeOff", $newStatusTimeOff, $site_setting->newStatusTimeOff, ["class"=>"form-control"]) !!}
                                    </div>
                                </div>
                            </div>     
                        </div>
                        <div class="secondry">
                            <div class="row">
                                <div class="item">
                                    <div class="form-group">
                                        <label>
                                            {!! Form::hidden("auto_generage_serial_number", 0) !!}
                                            {!! Form::checkbox("auto_generage_serial_number", 1, $global_setting->is_auto_generage_product_serial_number ? 'checked' : null) !!}
                                            Make auto generage for serial number of product?
                                        </label>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="form-group">
                                        <label>
                                            {!! Form::hidden("is_support_paypal_payment", 0) !!}
                                            {!! Form::checkbox("is_support_paypal_payment", 1, $global_setting->is_support_paypal_payment ? 'checked' : null) !!}
                                            support paypal payment?
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cart-setting">
                        <p class="base-title"><u>Cart setting</u></p>
                        <div class="primary">
                            <div class="row">
                                <div class="item">
                                    <div class="form-group">
                                        <label>
                                            {!! Form::hidden("clear_cart_when_logout", 0) !!}
                                            {!! Form::checkbox("clear_cart_when_logout", 1, $global_setting->is_clear_cart_when_logout ? 'checked' : null) !!}
                                            Make clear for cart when user logout?
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    					
                        
					{!! Form::submit(trans("$TR.T6"), ["class"=>"btn btn-default pull-right"]) !!}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@stop
<?php
	/* Translation */
	$TR = "auth.register";
?>

@extends("front.$frontendNumber.master")
@section('title', trans("$TR.T0"))

@section('content')
	<div id="register-form" class="container">
		@include('includes.flash-message')
		@include('includes.back-error')

		{!! Form::open(["url"=>"/register"]) !!}
			<div class="form-group">
				{!! Form::label("userName", trans("$TR.T1")) !!}
                <span class="text-danger">*</span>
				{!! Form::text("name", "", ["class"=>"form-control", "id"=>"userName", "dir"=>"auto"]) !!}
				<p class="help-block opc-7">{{ trans("sub_validation.register.T1") }}</p>
			</div>
			<div class="form-group">
				{!! Form::label("emailAddress", trans("$TR.T7")) !!}
                <span class="text-danger">*</span>
				{!! Form::email("email", "", ["class"=>"form-control", "id"=>"emailAddress"]) !!}
			</div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label("userPassword", trans("$TR.T2")) !!}
                        <span class="text-danger">*</span>
                        {!! Form::password("password", ["class"=>"form-control", "id"=>"userPassword"]) !!}
                        <p class="help-block opc-7">{{ trans("sub_validation.register.T3") }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label("confirmationPassword", trans("$TR.T2")) !!}
                        <span class="text-danger">*</span>
                        {!! Form::password("password_confirmation", ["class"=>"form-control", "id"=>"confirmationPassword"]) !!}
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group">
                {!! Form::label("userCountry", "country") !!}
                <select name="country_id" class="form-control">
                    <option value="0">my country not founded</option>
                    @foreach(config('sensorization.seeds.countries') as $id => $country)
                        <option value="{{ $id + 1 }}">{{ $country }}</option>
                    @endforeach
                </select>
                <p class="help-block opc-7">
                    need for delivery method orders<br>
                    <a href="#">why my country not founded?</a>
                </p>
            </div>
            <div class="form-group">
                {!! Form::label("userAddress", "Full address") !!}
                {!! Form::textarea("address", "", ["class"=>"form-control", "id"=>"userAddress", "dir"=>"auto", "rows"=>4]) !!}
                <p class="help-block opc-7">need for delivery method orders</p>
            </div>
			{!! Form::submit(trans("$TR.T3"), ["class"=>"btn btn-primary"]) !!}

			<span class="message right-text">
				{{ trans("$TR.T4") }} <a href="/login">{{ trans("$TR.T5") }}</a>
			</span>
		{!! Form::close() !!}
	</div>
@stop
<?php
	/* Translation */
	$TR = "admin_panel.ADP";
?>

@extends('back.master')
@section('title', trans('admin_panel.APT.T1'))

@section('content')
	<div id="dashboard-page">
		<div class="panel panel-default">
			<div class="panel-heading">
				<b>{{ trans("$TR.T8") }}</b>
			</div>
			<div class="panel-body">
                <div class="row">
                    <div class="item">
                        <div class="title">{{ trans("$TR.T1") }}</div>
                        <div class="content">{{ number_format($products_count) }}</div>
                    </div>
                    <div class="item">
                        <div class="title">{{ trans("$TR.T2") }}</div>
                        <div class="content">{{ number_format($live_products_count) }}</div>
                    </div>
                    <div class="item">
                        <div class="title">{{ trans("$TR.T6") }}</div>
                        <div class="content">{{ number_format($visitor_count) }}</div>
                    </div> 
                    <div class="item">
                        <div class="title">{{ trans("$TR.T7") }}</div>
                        <div class="content">{{ number_format($visitor_count_lastWeek) }}</div>
                    </div>
                    <div class="item">
                        <div class="title">Tags count</div>
                        <div class="content">{{ number_format($tags_count) }}</div>
                    </div>
                    <div class="item">
                        <div class="title">{{ trans("$TR.T3") }}</div>
                        <div class="content">{{ number_format($products_carousel_count) }}</div>
                        <i class="text-warning">{{ trans("$TR.T5") }}</i>
                    </div>
				</div>
			</div>
		</div>
	</div>
@stop
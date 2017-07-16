<?php
	$pendingRequestsCount = App\Models\CartItem::where('status', 0)->count();
	$acceptedRequestsCount = App\Models\CartItem::where('status', 2)->count();

	/* Translation */
	$TR = "admin_panel.AN";
?>

<div class="list-group">
	<button class="resize-btn btn expanded">resize</button>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="icomoon-gears"></span>
			<span class="des">{{ trans("$TR.T6") }}</span>
            <a href="#" class="btn btn-default btn-xs pull-right slide-toggle" title="slide toggle">
                <span class="glyphicon glyphicon-chevron-up"></span>
            </a>
		</div>
		<div class="panel-body">
			<a href="/admin" class="list-group-item" data-toggle="tooltip" data-placement="right" title="{{ trans("$TR.T3") }}"> 
				<span class="icomoon-dashboard"></span> 
				<span class="des">{{ trans("$TR.T3") }}</span>
			</a>
			<a href="/admin/products" class="list-group-item" data-toggle="tooltip" data-placement="right" title="{{ trans("$TR.T5") }}">
				<span class="icomoon-items"></span>
				<span class="des">{{ trans("$TR.T5") }}</span>
			</a>
			<a href="/admin/products/create/step/1" class="list-group-item" data-toggle="tooltip" data-placement="right" title="{{ trans("$TR.T7") }}">
				<span class="icomoon-paper-add"></span>
				<span class="des">{{ trans("$TR.T7") }}</span>
			</a>
			<a href="/admin/products/categories" class="list-group-item" data-toggle="tooltip" data-placement="right" title="{{ trans("$TR.T8") }}">
				<span class="icomoon-branch"></span>
				<span class="des">{{ trans("$TR.T8") }}</span>
			</a>
			<a href="/admin/products/carousel" class="list-group-item" data-toggle="tooltip" data-placement="right" title="{{ trans("$TR.T9") }}">
				<span class="icomoon-gallery"></span>
				<span class="des">{{ trans("$TR.T9") }}</span>
			</a>
			<a href="/admin/products/tags" class="list-group-item" data-toggle="tooltip" data-placement="right" title="{{ trans("$TR.T10") }}">
				<span class="icomoon-tags"></span>
				<span class="des">{{ trans("$TR.T10") }}</span>
			</a>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="icomoon-gears"></span>
			<span class="des">{{ trans("$TR.T11") }}</span>
            <a href="#" class="btn btn-default btn-xs pull-right slide-toggle" title="slide toggle">
                <span class="glyphicon glyphicon-chevron-up"></span>
            </a>
		</div>
		<div class="panel-body">
			<a href="/admin/review-cart/pending-requests" class="list-group-item" data-toggle="tooltip" data-placement="right" title="{{ trans("$TR.T13") }}">
				<span class="icomoon-cart pending"></span>
				<span class="des">
					{{ trans("$TR.T12") }} ({{ trans("$TR.T13") }})
					<span class="badge pull-right">{{ $pendingRequestsCount }}</span>
				</span>
			</a>
			<a href="/admin/review-cart/accepting-requests" class="list-group-item" data-toggle="tooltip" data-placement="right" title="{{ trans("$TR.T14") }}">
				<span class="icomoon-cart accepted"></span>
				<span class="des">
					{{ trans("$TR.T12") }} ({{ trans("$TR.T14") }})
					<span class="badge pull-right">{{ $acceptedRequestsCount }}</span>
				</span>
			</a>
			<a href="/admin/clients/users/accounts" class="list-group-item" data-toggle="tooltip" data-placement="right" title="{{ trans("$TR.T15") }}">
				<span class="icomoon-users-crowd"></span>
				<span class="des">{{ trans("$TR.T15") }}</span>
			</a>
			<a href="/admin/clients/admins/accounts" class="list-group-item" data-toggle="tooltip" data-placement="right" title="{{ trans("$TR.T16") }}">
				<span class="icomoon-admin"></span>
				<span class="des">{{ trans("$TR.T16") }}</span>
			</a>
		</div>
	</div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="icomoon-gears"></span>
            <span class="des">Multiple control</span>
            <a href="#" class="btn btn-default btn-xs pull-right slide-toggle" title="slide toggle">
                <span class="glyphicon glyphicon-chevron-up"></span>
            </a>
        </div>
        <div class="panel-body">
            <a href="/admin/translations" class="list-group-item" data-toggle="tooltip" data-placement="right" title='Translations (CRUD)'>
                <span class="icomoon-translation"></span>
                <span class="des">Translations (CRUD)</span>
            </a>
        </div>
    </div>
	@if($personType == "super_admin")
		<div class="panel panel-default">
			<div class="panel-heading">
				<span class="icomoon-gears"></span>
				<span class="des">{{ trans("$TR.T17") }}</span>
                <a href="#" class="btn btn-default btn-xs pull-right slide-toggle" title="slide toggle">
                    <span class="glyphicon glyphicon-chevron-up"></span>
                </a>
			</div>
		  	<div class="panel-body">
		  		<a href="/admin/super-admin/edit" class="list-group-item" data-toggle="tooltip" data-placement="right" title='{{ trans("$TR.T19") }}'>
		  			<span class="icomoon-paper-edit"></span>
		  			<span class="des">{{ trans("$TR.T19") }}</span>
		  		</a>
		    	<a href="/admin/clients/admins/accounts/create" class="list-group-item" data-toggle="tooltip" data-placement="right" title='{{ trans("$TR.T20") }}'>
		    		<span class="icomoon-lock"></span>
		    		<span class="des">{{ trans("$TR.T20") }}</span>
		    	</a>
				<a href="/admin/site-setting" class="list-group-item" data-toggle="tooltip" data-placement="right" title="{{ trans("$TR.T21") }}">
					<span class="icomoon-gears"></span>
					<span class="des">{{ trans("$TR.T21") }}</span>
				</a>
		  	</div>
		</div>
	@endif
</div>

{{ Session::get('leftnav_resize_status') }}

<script type="text/javascript">
	$(document).ready(function(){
		navLinkActivation('/{{Request::path()}}');
		leftnav_resize_status($('.resize-btn'), "{{ Session::has('leftnav_resize_status') }}", "{{ Session::get('leftnav_resize_status') }}");

		$('.resize-btn').click(function(){
			var _this = $(this);
			var leftNav = $("#left-nav");
			var content = $("#content");
			var status = leftNav.hasClass('col-md-3');

            console.log(status);

			leftNav.toggleClass('col-md-3 col-md-1');
			content.toggleClass('col-md-9 col-md-11');

			if(status) {
				leftNav.find(".des").hide();
				leftNav.find(".list-group-item").css("text-align", "center");
				leftNav.find(".panel-heading")
                    .css("text-align", "center").end()
                    .find('.slide-toggle').hide();
				tooltip_status('show');
			} else {
				leftNav.find(".des").fadeIn(200);
				leftNav.find(".list-group-item").css("text-align", "left");
				leftNav.find(".panel-heading")
                    .css("text-align", "left").end()
                    .find('.slide-toggle').show();
				tooltip_status('hide');
			}

			// send to controller to set new status ib session
			$.ajax({
				url: "/requesting/ajax/backend-leftnav-status",
				type: "post",
				data: { status: status }
			})
		});
	});
</script>

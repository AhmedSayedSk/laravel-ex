<?php 
    /* Translation */
    //$TR = "frontend.$frontendNumber.UP.DB"; 
?>

@extends("front.$frontendNumber.user.master")
@section('title', "Pay requests")

@section('content')
    <div id="pay-requests-view-page">
        <div class="panel panel-default">
            <div class="panel-heading">
                <b>pay requests</b>
            </div>
            <div class="panel-body">
                <div class="container-fluid">
                    @if(count($requests) <= 0)
                        <div class="text-center empty-content">
                            <h3>No pay requests yet</h3>
                        </div>
                    @else
                        <div id="response-table">
                            <table class="table table-striped table-hover sortable ps-view">
                                <thead>
                                    <tr>
                                        <th>Item name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Payment method</th>
                                        <th>Status</th>
                                        <th>Created at</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($requests as $request)
                                        <tr>
                                            <td data-title='Item name'>
                                                {{ $request->product_name }}
                                            </td>
                                            <td data-title='Price'>
                                                {{ number_format($request->product_price) }} 
                                                {{ $request->product_currency }}
                                            </td>
                                            <td data-title='Quantity'>
                                                {{ $request->product_quantity }}
                                            </td>
                                            <td data-title='Payment method'>
                                                {{ $request->payment_method }}
                                            </td>
                                            <td data-title='Status'>
                                                @if($request->status == 2)
                                                    accepted
                                                @elseif($request->status == 1)
                                                    rejected
                                                @elseif($request->status == 0)
                                                    pending
                                                @endif
                                            </td>
                                            <td data-title='Created at'>
                                                {{ $request->created_at }}
                                            </td>
                                            <td data-title='Options'>
                                                {!! Form::open(["url"=>"pay-requests/$request->id", "method"=>"DELETE"]) !!}
                                                    <button type="submit" class="btn btn-default btn-sm">
                                                        <span class="glyphicon glyphicon-remove"></span> remove
                                                    </button>
                                                {!! Form::close() !!}
                                                <a href="/pay-requests/cancel/{{ $request->id }}" class="btn btn-default btn-sm">
                                                    <span class="glyphicon glyphicon-pause"></span> cancle
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
            <div class="text-center">
                {!! $requests->render() !!}
            </div>
        </div>
    </div>
@stop

@section('head-css')
    <link rel="stylesheet" type="text/css" href="./packages/bootstrap-sortable/Contents/bootstrap-sortable.css">
@stop

@section('footer-js')
    <script type="text/javascript" src="./packages/bootstrap-sortable/Scripts/bootstrap-sortable.js"></script>
    <script type="text/javascript" src="./packages/bootstrap-sortable/Scripts/moment.min.js"></script>
@stop
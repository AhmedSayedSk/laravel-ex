@extends('back.master')
@section('title', "transLations")

@section('content')
    <div id="translations-view-page">
        @include('includes.flash-message')
        @include('includes.back-error')

        <div class="panel panel-default">
            <div class="panel-heading">
                Translations section
                <a href="/admin/translations/take-backup" class="btn btn-success btn-sm pull-right">
                    Take backup
                </a>
                <a href="/admin/translations/create" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#Modal" data-remote="false">
                    Add new translation
                </a>
            </div>
            <div class="panel-body">
                <div class="container-fluid">
                    @if(count($translations) == 0)
                        <div class="text-center empty-content">
                            <h3>No translations yet</h3>
                        </div>
                    @else
                        <div id="response-table">
                            <table class="table table-striped table-hover sortable ps-view">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>en</th>
                                        <th>ar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($translations as $trans)
                                        <tr data-id="{{ $trans->id }}">
                                            <td>{{ $trans->id }}</td>
                                            <td><a href="#" data-toggle="popover" data-trans-key="en">{{ $trans->en }}</a></td>
                                            <td><a href="#" data-toggle="popover" data-trans-key="ar">{{ $trans->ar }}</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="text-center">
            {!! $translations->render() !!}
        </div>
    </div>

    <div class="popoverContent" style="display: none !important">
        <div class="form-group">
            <textarea class="form-control input-lg" rows="3" placeholder="some translation" dir="auto"></textarea>
        </div>
        <button class="submit btn btn-primary btn-sm">update</button>
    </div>

    <!-- Default bootstrap modal example -->
    @include('standers.modal')
@stop

@section('head-css')
    <link rel="stylesheet" type="text/css" href="./packages/bootstrap-sortable/Contents/bootstrap-sortable.css">
@stop

@section('footer-js')
    <script type="text/javascript" src="./packages/bootstrap-sortable/Scripts/bootstrap-sortable.js"></script>
    <script type="text/javascript" src="./packages/bootstrap-sortable/Scripts/moment.min.js"></script>
    <script type="text/javascript" src="./assets/js/links-optimization.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            tagModal([
                'Create translations'
            ], null, 'GET', null)
        })
    </script>

    <script type="text/javascript" data-des="popover">
        $(document).ready(function(){
            $('[data-toggle="popover"]').each(function( index ) {
                var that = $(this);

                $(this).popover({
                    html: true,
                    placement: 'top',
                    trigger: 'click',
                    delay: {
                        "hide": 350 
                    },
                    content: function () {
                          return $('.popoverContent').html();
                    }       
                })
            }).on('shown.bs.popover', function(){
                var _this = $(this);
                var parent = _this.find('+ div .popover-content');
                var textarea = parent.find('textarea');

                // default translation
                textarea.val(_this.text());

                parent.delegate('.submit', 'click', function(){
                    var trans_id = _this.parents('tr').attr('data-id');
                    var trans_key = _this.attr('data-trans-key');
                    var trans_content = textarea.val();

                    $.ajax({
                        url: '/admin/translations/' + trans_id,
                        type: 'post',
                        data: {
                            _method: 'patch',
                            key: trans_key,
                            content: trans_content
                        },
                        success: function(data){
                            // new translation
                            _this.text(data.content);

                            _this.popover('hide');
                        }
                    })
                })

            }).on('hide.bs.popover', function(){
                $('.popoverContent textarea').text('');
            });
        })
    </script>
@stop

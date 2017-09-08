@extends('admin::layouts.master')

@section('title')
    {{trans('cms::utilities.log.page_title')}} | @parent
@stop

@push('styles')
<style>
    .stack {
        font-size: 0.85em;
    }

    .date {
        min-width: 75px;
    }

    .text {
        word-break: break-all;
    }

    a.llv-active {
        z-index: 2;
        background-color: #f5f5f5;
        border-color: #777;
    }
</style>
@endpush

@section('page-title')
    @pageHeader('cms::utilities.log.page_title','cms::utilities.log.description', 'cms::utilities.log.icon')
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">
                <i class="fa fa-list-alt"></i> {{trans('cms::utilities.log.app_log')}}
            </h3>
            <div class="box-tools pull-right">
                <a href="?dl={{ base64_encode($current_file) }}" class="btn btn-default btn-sm">
                    <span class="glyphicon glyphicon-download-alt"></span>
                    {{trans('cms::utilities.log.download')}}
                </a>
                <a id="delete-log" href="?del={{ base64_encode($current_file) }}" class="btn btn-danger btn-sm">
                    <span class="glyphicon glyphicon-trash"></span> {{trans('cms::utilities.log.delete')}}
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-3 col-md-2">
                    <ul class="list-group">
                        @foreach($files as $file)
                            <a href="?l={{ base64_encode($file) }}"
                               class="list-group-item @if($current_file == $file) llv-active @endif">
                                {{$file}}
                            </a>
                        @endforeach
                    </ul>
                </div>
                <div class="col-sm-9 col-md-10">
                    @if($logs === null)
                        <div>
                            {{trans('cms::utilities.log.file_over_50')}}
                        </div>
                    @else
                        <table id="table-log" class="table table-striped">
                            <thead>
                            <tr>
                                <th>{{trans('cms::utilities.log.level')}}</th>
                                <th width="110px">{{trans('cms::utilities.log.date')}}</th>
                                <th>{{trans('cms::utilities.log.content')}}</th>
                            </tr>
                            </thead>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="stack-modal">
    	<div class="modal-dialog modal-lg">
    		<div class="modal-content">
    			<div class="modal-header">
    				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    				<h4 class="modal-title" id="stack-text"></h4>
    			</div>
    			<div class="modal-body">
    				<div id="stack-file" class="lead"></div>
    				<div id="stack-details"></div>
    			</div>
    			<div class="modal-footer">
    				<button type="button" class="btn btn-default" data-dismiss="modal">{{trans('cms::button.close')}}</button>
    			</div>
    		</div>
    	</div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        var oTable = $('#table-log').DataTable({
            "order": [1, 'desc'],
            "button": true,
            "buttons": ['reset', 'reload'],
            "serverSide": true,
            "processing": true,
            "ajax": "",
            "stateSave": true,
            "columns": [
                {data: "level"},
                {data: "date"},
                {data: "content"},
                {data: "text", visible: false},
                {data: "in_file", visible: false},
                {data: "stack", visible: false}
            ]
        }).on('click', '.expand', function () {
            var tr = $(this).parents(tr);
            var data = oTable.row(tr).data();
            $('#stack-text').html(data.text);
            if (! data.in_file) {
                $('#stack-file').hide();
            } else {
                $('#stack-file').show();
                $('#stack-file').html(data.in_file);
            }
            $('#stack-details').html(data.stack);
            $('#stack-modal').modal('show');
        });

        $('#delete-log').click(function () {
            return confirm("{{trans('cms::utilities.log.delete_confirm')}}");
        });
    });
</script>
@endpush

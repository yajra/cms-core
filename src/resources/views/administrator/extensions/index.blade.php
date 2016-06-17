@extends('admin::layouts.master')

@section('title')
    {{trans('cms::extension.title')}} | @parent
@endsection

@section('page-title')
    @pageHeader('cms::extension.title', 'cms::extension.description', 'cms::extension.icon')
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">
                <i class="fa fa-list"></i>&nbsp;{{trans('cms::extension.lists')}}
            </h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            {!! $dataTable->table() !!}
        </div>
    </div>
@stop

@push('scripts')
{!! $dataTable->scripts() !!}
<script>
    $(function () {
        $('.btn-delete').on('click', function (e) {
            var form = $(this).parents('form');
            e.preventDefault();
            swal({
                title: "{{trans('cms::extension.confirm.title')}}",
                text: "{{trans('cms::extension.confirm.text')}}",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "{{trans('cms::extension.confirm.cancel')}}",
                confirmButtonText: "{{trans('cms::extension.confirm.yes')}}",
                closeOnConfirm: false
            }, function () {
                form.submit();
            });
        });
    });
</script>
@endpush

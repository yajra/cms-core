@extends('admin::layouts.master')

@section('title')
{{trans('cms::permission.index.title')}} | @parent
@stop

@push('styles')
@endpush

@section('page-title')
    @pageHeader('cms::permission.index.title', 'cms::permission.index.description', 'cms::permission.index.icon')
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">
                <i class="fa fa-list"></i>&nbsp;
                {{trans('cms::permission.index.list')}}
            </h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            {!! $dataTable->table(['id' => 'permissions-table', 'class' => 'table table-hover']) !!}
        </div>
    </div>
@stop

@push('scripts')
<script>
    (function ($, DataTable) {
        "use strict";

        DataTable.ext.buttons.resource = {
            className: 'buttons-create btn-dt-default',

            text: function (dt) {
                return '<i class="fa fa-database"></i> ' + dt.i18n('buttons.create', 'Create Resource');
            },

            action: function (e, dt, button, config) {
                window.location = window.location.href.replace(/\/+$/, "") + '/create-resource';
            }
        };
    })(jQuery, jQuery.fn.dataTable);
</script>
{!! $dataTable->scripts() !!}
@endpush

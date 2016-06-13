@extends('admin::layouts.master')

@section('title')
    Lookup Registry | @parent
@stop

@push('styles')
<style>
    .list-group-padding {padding-left: 10px !important;}
    a.disabled {pointer-events: none;}
</style>
@endpush

@section('page-title')
    @pageHeader('Lookup Registry', 'Register your lookups here.', 'fa fa-folder-open')
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <p class="text-muted text-center text-uppercase">Lookup Filters</p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item list-group-padding">
                            <a href="#" class="btn-filter">
                                <i class="fa fa-list"></i>&nbsp;All Types
                            </a>
                        </li>
                        <li class="list-group-item list-group-padding">
                            <a href="#" class="btn-filter" data-type="widgets.types">
                                <i class="fa fa-filter"></i>&nbsp;Widget Types
                            </a>
                        </li>
                        @foreach(\Yajra\CMS\Entities\Lookup::type('widgets.types')->get() as $widget)
                        <li class="list-group-item list-group-padding">
                            <a href="#" class="btn-filter" data-type="widgets.{{$widget->key}}.templates">
                                <i class="fa fa-filter"></i>&nbsp;Widget Templates <span class="label label-info">{{ $widget->value }}</span>
                            </a>
                        </li>
                        @endforeach
                        <li class="list-group-item list-group-padding">
                            <a href="#" class="btn-filter" data-type="widgets.positions">
                                <i class="fa fa-filter"></i>&nbsp;Widget Positions
                            </a>
                        </li>
                        <li class="list-group-item list-group-padding">
                            <a href="#" class="btn-filter" data-type="menu.types">
                                <i class="fa fa-filter"></i>&nbsp;Menu Types
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="fa fa-list"></i>&nbsp;
                        Registered Lookups
                    </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    {!! $dataTable->table(['class' => 'table table-hover margin-top-30']) !!}
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
<script>
    (function ($, DataTable) {
        "use strict";

        DataTable.ext.buttons.create = {
            className: 'buttons-create',

            text: function (dt) {
                return '<i class="fa fa-plus"></i> ' + dt.i18n('buttons.create', 'New Registry');
            },

            action: function (e, dt, button, config) {
                window.location = '{{ route('administrator.lookup.create') }}';
            }
        };
    })(jQuery, jQuery.fn.dataTable);
</script>
{!! $dataTable->scripts() !!}
<script>
    $(function(){
        var type = '';
        $('.btn-filter').on('click', function(e) {
            e.preventDefault();
            type = $(this).data('type');
            LaravelDataTables['dataTableBuilder'].draw();

            $('.list-group-item').css('background', '#FFFFFF');
            $('.list-group-item a').css('color', '#3c8dbc');

            $(this).parent().css('background', '#F5F5F5');
            $(this).css('color', '#2f353b');
        });
        $('ul.list-group.list-group-unbordered li a.btn-filter').first().trigger('click');

        LaravelDataTables['dataTableBuilder'].on('preXhr.dt', function ( e, settings, data ) {
            data.type = type;
        });
    });
</script>
@endpush
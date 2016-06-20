@extends('admin::layouts.master')

@push('styles')
<style>
    .select2-search__field {
        border: none !important;
    }
</style>
@endpush

@section('title')
{{trans('cms::user.index.title')}} | @parent
@stop

@section('page-title')
    @pageHeader('cms::user.index.title', 'cms::user.index.description', 'cms::user.index.icon')
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">
                <i class="fa fa-search"></i>&nbsp;
                {{trans('cms::user.index.search')}}
                <small>search and filter records.</small>
            </h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6 col-xs-6">
                    <select name="activated" id="activated" multiple class="select2 input-sm form-control"
                            data-placeholder="{{trans('cms::user.index.activation')}}">
                        <option value=""></option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <div class="col-md-6 col-xs-6">
                    {!! form()->select('roles', $roles , null , ['class' => 'form-control select2 input-sm', 'multiple', 'data-placeholder' => trans('cms::user.index.role')]) !!}
                </div>
            </div>
            <div style="margin-top: 20px;">
                <div class="row">
                    <div class="col-md-12">
                        {!! $dataTable->table(['id' => 'users-table', 'class' => 'table table-hover']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
{!! $dataTable->scripts() !!}
<script type="text/javascript">
    $(document).ready(function () {
        $('#users-table').on('preXhr.dt', function (e, settings, data) {
            data.status = $('select[name=activated]').val();
            data.companies = $('select[name=companies]').val();
            data.roles = $('select[name=roles]').val();
            data.deleted = $('input.trashed').prop('checked')
        });

        $('select[name=roles], select[name=activated], select[name=companies]').on('change', function () {
            LaravelDataTables['users-table'].draw();
        });
    });
</script>
@endpush

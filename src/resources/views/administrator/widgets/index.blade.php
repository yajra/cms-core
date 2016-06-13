@extends('admin::layouts.master')

@section('title')
Widgets | @parent
@stop

@push('styles')
@endpush

@section('page-title')
    @pageHeader('Widget Manager', 'Manage site widgets.', 'fa fa-plug')
@stop

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">
            <i class="fa fa-list"></i>&nbsp;
            Widget Lists
        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        {!! $dataTable->table(['id' => 'widgets-table', 'class' => 'table table-hover']) !!}
    </div>
</div>
@stop

@push('scripts')
{!! $dataTable->scripts() !!}
@endpush

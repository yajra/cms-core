@extends('admin::layouts.master')

@section('title')
{{trans('cms::widget.index.title')}} | @parent
@stop

@push('styles')
@endpush

@section('page-title')
    @pageHeader('cms::widget.index.title', 'cms::widget.index.description', 'cms::widget.index.icon')
@stop

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">
            <i class="fa fa-list"></i>&nbsp;
            {{trans('cms::widget.index.lists')}}
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

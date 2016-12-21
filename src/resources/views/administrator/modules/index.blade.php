@extends('admin::layouts.master')

@section('title')
    {{trans('cms::module.index.title')}}| @parent
@stop

@section('page-title')
    @pageHeader('cms::module.index.title', 'cms::module.index.description', 'fa fa-file-text')
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">
                <i class="fa fa-list"></i>&nbsp;
                {{trans('cms::module.index.title')}}
            </h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
          {!! $dataTable->table(['class' => 'table table-hover margin-top-30']) !!}
        </div>
    </div>
@stop

@push('scripts')
{!! $dataTable->scripts() !!}
@endpush

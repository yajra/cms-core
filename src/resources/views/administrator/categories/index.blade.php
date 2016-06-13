@extends('admin::layouts.master')

@section('title')
    {{trans('categories.index.title')}}| @parent
@stop

@section('page-title')
    @pageHeader('categories.index.page-title', 'categories.index.page-desc', 'fa fa-file-text')
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">
                <i class="fa fa-list"></i>&nbsp;
                {{trans('categories.index.box-title')}}
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
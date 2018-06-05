@extends('layouts.master')

@section('title')
    {{trans('cms::tag.index.title')}} | @parent
@stop

@section('page-title')
    @pageHeader('cms::tag.index.page-title', 'cms::tag.index.page-desc', 'fa fa-tags')
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">
                <i class="fa fa-table"></i>&nbsp;
                {{trans('cms::tag.index.title')}}
            </h3>
        </div>
        <div class="box-body">
            {{ $dataTable->table(['class' => 'table table-hover margin-top-30']) }}
        </div>
    </div>
@stop

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush

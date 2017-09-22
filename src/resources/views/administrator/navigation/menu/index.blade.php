@extends('layouts.master')

@section('title')
{{trans('cms::menu.index.title')}} | @parent
@stop

@section('page-title')
    @pageHeader('cms::menu.index.title', '['.$navigation->title.' '.trans('cms::menu.index.description').']', 'cms::menu.index.icon')
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">
                <i class="fa fa-table"></i> {{trans('cms::menu.index.title')}}
            </h3>
            <div class="box-tools pull-right">
                <a href="{{route('administrator.navigation.index')}}" class="btn btn-sm btn-default">
                    <i class="fa fa-arrow-circle-left"></i>&nbsp;
                    {{trans('cms::menu.index.back')}}
                </a>
            </div>
        </div>
        <div class="box-body">
            {{ $dataTable->table(['class' => 'table table-hover ']) }}
        </div>
    </div>
@stop

@push('scripts')
{{ $dataTable->scripts() }}
@endpush

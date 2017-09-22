@extends('layouts.master')

@section('title')
    {{trans('cms::categories.index.title')}} | @parent
@stop

@section('page-title')
    @pageHeader('cms::categories.index.page-title', 'cms::categories.index.page-desc', 'fa fa-folder-open-o')
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">
                <i class="fa fa-table"></i>&nbsp;
                {{trans('cms::categories.index.title')}}
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

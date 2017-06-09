@extends('admin::layouts.master')

@section('title')
{{trans('cms::role.index.title')}} | @parent
@stop

@push('styles')
@endpush

@section('page-title')
    @pageHeader('cms::role.index.title', 'cms::role.index.description', 'cms::role.index.icon')
@stop

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">
            <i class="fa fa-table"></i>&nbsp;
            {{trans('cms::role.index.title')}}
        </h3>
    </div>
    <div class="box-body">
        {!! $dataTable->table(['id' => 'roles-table', 'class' => 'table table-hover']) !!}
    </div>
</div>
@stop

@push('scripts')
{!! $dataTable->scripts() !!}
@endpush

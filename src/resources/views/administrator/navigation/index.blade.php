@extends('admin::layouts.master')

@section('title')
{{trans('cms::navigation.index.title')}} | @parent
@endsection

@section('page-title')
    @pageHeader('cms::navigation.index.title', 'cms::navigation.index.description', 'cms::navigation.index.icon')
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">
                <i class="fa fa-table"></i>&nbsp;{{trans('cms::navigation.index.title')}}
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

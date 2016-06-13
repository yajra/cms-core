@extends('admin::layouts.master')

@section('title')
{{trans('navigation.index.title')}} | @parent
@stop

@section('page-title')
    @pageHeader('menu.index.title', '['.$navigation->title.' '.trans('menu.index.description').']', 'menu.index.icon')
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">
                <a href="/administrator/navigation" style="font-size: 15px">
                    <i class="fa fa-arrow-circle-left"></i>&nbsp;
                    {{trans('menu.index.back')}}
                </a>
            </h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            {!! $dataTable->table(['class' => 'table table-hover ']) !!}
        </div>
    </div>
@stop

@push('scripts')
{!! $dataTable->scripts() !!}
@endpush

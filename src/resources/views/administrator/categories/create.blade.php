@extends('admin::layouts.master')

@section('title')
    {{trans('categories.create.title')}} | @parent
@stop

@section('page-title')
    @pageHeader('categories.create.page-title', 'categories.create.page-desc', 'fa fa-plus')
@stop

@section('content')
    {!! form()->model($category, ['url' => route('administrator.categories.store')]) !!}
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 style="color: #505b69;" class="box-title">{{trans('categories.create.require')}}</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            @include('administrator.categories.partials.form')
        </div>
        <div class="box-footer">
            <a href="{{ route('administrator.categories.index') }}" class="btn btn-warning text-bold text-uppercase">
                {{trans('categories.create.button.cancel')}}
            </a>
            <button type="submit" class="btn btn-primary text-bold text-uppercase">
                <i class="fa fa-check"></i> {{trans('categories.create.button.save')}}
            </button>
        </div>
    </div>
    {!! form()->close() !!}
@stop

@push('scripts')

@endpush
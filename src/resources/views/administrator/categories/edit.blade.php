@extends('admin::layouts.master')

@section('title')
    {{trans('cms::categories.edit.title')}} | @parent
@stop

@section('page-title')
    @pageHeader('cms::categories.edit.page-title', 'cms::categories.edit.page-desc', 'fa fa-edit')
@stop

@section('content')
    {!! form()->model($category, ['url' => route('administrator.categories.update', $category->id), 'method' => 'PUT']) !!}
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 style="color: #505b69;" class="box-title">{{trans('cms::categories.edit.require')}}</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            @include('administrator.categories.partials.form')
        </div>
        <div class="box-footer">
            <a href="{{ route('administrator.categories.index') }}" class="btn btn-warning text-bold">
                {{trans('cms::categories.edit.button.cancel')}}
            </a>
            <button type="submit" class="btn btn-primary text-bold">
                {{trans('cms::categories.edit.button.update')}}
            </button>
        </div>
    </div>
    {!! form()->close() !!}
@stop

@push('scripts')

@endpush
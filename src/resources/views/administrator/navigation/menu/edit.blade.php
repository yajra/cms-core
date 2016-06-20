@extends('admin::layouts.master')

@section('body', 'sidebar-collapse')

@section('title')
{{trans('cms::navigation.edit.title')}} | @parent
@stop

@push('styles')
<style>
    .blockUI {
        z-index: 10000 !important;
    }

    .blockMsg {
        background: none !important;
        border: none !important;
        font-size: 8px !important;
        color: #FFFFFF !important;
    }

    .blockMsg h1 {
        font-size: 16px !important;
    }
</style>
@endpush

@section('page-title')
    @pageHeader('cms::menu.edit.title', '['.$navigation->title.' '.trans('cms::menu.edit.description').']', 'cms::menu.edit.icon')
@stop

@section('content')
    {!! form()->model($menu, ['url' => route('administrator.navigation.menu.update', [$navigation->id,$menu->id]), 'method' => 'PUT', "id"=>"form-container"]) !!}
    <div class="box box-primary">
        <div class="box-body">
            <a href="{{ route('administrator.navigation.menu.index', $navigation->id) }}"
               class="btn btn-warning text-bold">
                {{trans('cms::button.cancel')}}
            </a>
            <button type="submit" class="btn btn-primary text-bold">
                {{trans('cms::button.update')}}
            </button>
        </div>
    </div>

    @include('administrator.navigation.menu.partials.form')

    {!! form()->close() !!}

    @include('administrator.navigation.menu.partials.modal.articles')
@stop

@push('scripts')
@include('administrator.navigation.menu.partials.script')
@endpush

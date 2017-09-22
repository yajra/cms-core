@extends('layouts.master')

@section('body', 'sidebar-collapse')

@section('title')
{{trans('cms::navigation.create.title')}} | @parent
@stop

@section('page-title')
    @pageHeader('cms::menu.create.title', '['.$navigation->title.' '.trans('cms::menu.create.description').']', 'cms::menu.create.icon')
@stop

@section('content')
    {!! form()->model($menu, ['url' => route('administrator.navigation.menu.store', $navigation->id), "id"=>"menu-app"]) !!}
    <div class="box box-solid">
        <div class="box-body">
            <a href="{{ route('administrator.navigation.menu.index', $navigation->id) }}"
               class="btn btn-warning text-bold text-uppercase">
                {{trans('cms::button.cancel')}}
            </a>
            <button type="submit" class="btn btn-primary text-bold text-uppercase">
                <i class="fa fa-check"></i>
                {{trans('cms::button.save')}}
            </button>
        </div>
    </div>

    @include('administrator.navigation.menu.partials.form')
    @include('administrator.navigation.menu.partials.modal.articles')

    {!! form()->close() !!}
@stop

@push('scripts')
<script>window.menu = {!! $menu !!}</script>
<script>window.extensions = {!! $extensions !!}</script>
@include('administrator.navigation.menu.partials.script')
@endpush

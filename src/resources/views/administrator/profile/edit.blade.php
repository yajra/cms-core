@extends('admin::layouts.master')

@push('styles')
<style>
    .select2-search__field {
        border: none !important;
    }
</style>
@endpush

@section('title')
    {{trans('cms::profile.edit.title')}} | @parent
@stop

@section('page-title')
    @pageHeader('cms::profile.edit.page-title', 'cms::profile.edit.page-desc', 'fa fa-user')
@stop

@section('content')
    {!! form()->model(current_user(), ['files'  => true]) !!}
    @include('administrator.profile.partials.info')
    {!! form()->close() !!}
@stop


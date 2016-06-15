@extends('admin::layouts.master')

@section('title')
    {{trans('cms::utilities.index.title')}} | @parent
@stop

@push('styles')
@endpush

@section('page-title')
    @pageHeader('cms::utilities.index.title', 'cms::utilities.index.description', 'cms::utilities.index.icon')
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-list"></i> {{trans('cms::utilities.index.lists')}}</h3>
        </div>
        <div class="box-body">
            <button class="btn btn-app" data-post="{{ route('administrator.utilities.backup') }}">
                <i class="fa fa-save"></i> {{trans('cms::utilities.field.run_backup')}}
            </button>
            <button class="btn btn-app" data-post="{{ route('administrator.utilities.backup', ['clean']) }}">
                <i class="fa fa-folder-o"></i> {{trans('cms::utilities.field.clean_backup')}}
            </button>
            <button class="btn btn-app" data-post="{{ route('administrator.utilities.cache') }}">
                <i class="fa fa-database"></i> {{trans('cms::utilities.field.clear_cache')}}
            </button>
            <button class="btn btn-app" data-post="{{ route('administrator.utilities.views') }}">
                <i class="fa fa-files-o"></i> {{trans('cms::utilities.field.clear_views')}}
            </button>
            <button class="btn btn-app" data-post="{{ route('administrator.utilities.config', 'clear') }}">
                <i class="fa fa-gear"></i> {{trans('cms::utilities.field.clear_config')}}
            </button>
            <button class="btn btn-app" data-post="{{ route('administrator.utilities.config', 'cache') }}">
                <i class="fa fa-gear"></i> {{trans('cms::utilities.field.cache_config')}}
            </button>
            <a class="btn btn-app" href="{{ route('administrator.utilities.logs') }}">
                <i class="fa fa-exclamation-triangle"></i> {{trans('cms::utilities.field.log_viewer')}}
            </a>
        </div>
    </div>
@stop

@push('scripts')
@endpush

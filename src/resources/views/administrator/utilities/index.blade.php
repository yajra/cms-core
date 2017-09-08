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
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-upload"></i> Back Up!</h3>
                </div>
                <div class="box-body">
                    <button class="btn btn-app" data-post="{{ route('administrator.utilities.backup') }}">
                        <i class="fa fa-save"></i> {{trans('cms::utilities.field.run_backup')}}
                    </button>
                    <button class="btn btn-app"
                            data-post="{{ route('administrator.utilities.backup', ['clean']) }}">
                        <i class="fa fa-folder-o"></i> {{trans('cms::utilities.field.clean_backup')}}
                    </button>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-tree"></i> Nested Sets</h3>
                </div>
                <div class="box-body">
                    <button class="btn btn-app" data-post="{{ route('administrator.utilities.menu.rebuild') }}">
                        <i class="fa fa-list-ul"></i> {{trans('cms::utilities.menu.rebuild')}}
                    </button>
                    <button class="btn btn-app"
                            data-post="{{ route('administrator.utilities.category.rebuild') }}">
                        <i class="fa fa-file-o"></i> {{trans('cms::utilities.category.rebuild')}}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-files-o"></i> Cache</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-app" data-post="{{ route('administrator.utilities.cache') }}">
                                <i class="fa fa-database"></i> {{trans('cms::utilities.field.clear_cache')}}
                            </button>
                            <button class="btn btn-app" data-post="{{ route('administrator.utilities.views') }}">
                                <i class="fa fa-files-o"></i> {{trans('cms::utilities.field.clear_views')}}
                            </button>
                            <button class="btn btn-app"
                                    data-post="{{ route('administrator.utilities.config', 'clear') }}">
                                <i class="fa fa-gear"></i> {{trans('cms::utilities.field.clear_config')}}
                            </button>
                            <button class="btn btn-app"
                                    data-post="{{ route('administrator.utilities.route', 'clear') }}">
                                <i class="fa fa-arrows"></i> {{trans('cms::utilities.field.clear_route')}}
                            </button>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-app"
                                    data-post="{{ route('administrator.utilities.config', 'cache') }}">
                                <i class="fa fa-gear"></i> {{trans('cms::utilities.field.cache_config')}}
                            </button>
                            <button class="btn btn-app"
                                    data-post="{{ route('administrator.utilities.route', 'cache') }}">
                                <i class="fa fa-arrows"></i> {{trans('cms::utilities.field.cache_route')}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-exclamation-triangle"></i> Logs</h3>
                </div>
                <div class="box-body">
                    <a class="btn btn-app" href="{{ route('administrator.utilities.logs') }}">
                        <i class="fa fa-eye"></i> {{trans('cms::utilities.field.log_viewer')}}
                    </a>
                    <a class="btn btn-app" href="{{ route('administrator.utilities.info') }}">
                        <i class="fa fa-info"></i> {{trans('cms::utilities.field.phpinfo')}}
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
@endpush

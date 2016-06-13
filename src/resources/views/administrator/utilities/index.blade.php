@extends('admin::layouts.master')

@section('title')
    Utilities | @parent
@stop

@push('styles')
@endpush

@section('page-title')
    @pageHeader('Utilities', 'Site administration utilities.', 'fa fa-wrench')
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-list"></i> Available Tools</h3>
        </div>
        <div class="box-body">
            <button class="btn btn-app" data-post="{{ route('administrator.utilities.backup') }}">
                <i class="fa fa-save"></i> Run Back-Up
            </button>
            <button class="btn btn-app" data-post="{{ route('administrator.utilities.backup', ['clean']) }}">
                <i class="fa fa-folder-o"></i> Clean Back-Up
            </button>
            <button class="btn btn-app" data-post="{{ route('administrator.utilities.cache') }}">
                <i class="fa fa-database"></i> Clear Cache
            </button>
            <button class="btn btn-app" data-post="{{ route('administrator.utilities.views') }}">
                <i class="fa fa-files-o"></i> Clear Views
            </button>
            <button class="btn btn-app" data-post="{{ route('administrator.utilities.config', 'clear') }}">
                <i class="fa fa-gear"></i> Clear Config
            </button>
            <button class="btn btn-app" data-post="{{ route('administrator.utilities.config', 'cache') }}">
                <i class="fa fa-gear"></i> Cache Config
            </button>
            <a class="btn btn-app" href="{{ route('administrator.utilities.logs') }}">
                <i class="fa fa-exclamation-triangle"></i> Log Viewer
            </a>
        </div>
    </div>
@stop

@push('scripts')
@endpush

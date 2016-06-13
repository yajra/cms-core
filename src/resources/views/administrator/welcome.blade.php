@extends('admin::layouts.master')

@section('page-title')

@stop

@section('content')
    @include('administrator.dashboard.stats')

    <div class="row">
        <div class="col-md-6">
            @include('administrator.dashboard.latest')
        </div>

        <div class="col-md-6">
            @include('administrator.dashboard.popular')
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            @include('administrator.dashboard.config')
        </div>
    </div>
@endsection

@extends('admin::layouts.error')

@section('title')
403 - Access Forbidden | {{ config('site.name') }}
@stop

@section('page-title')
403 - Access Forbidden | {{ config('site.name') }}
@stop

@section('content')
<div class="error-page">
    <h1 class="headline text-info"> 403</h1>
    <div class="error-content">
        <h3><i class="fa fa-warning text-info"></i> Server Error: 403 (Forbidden).</h3>
        <p>
            We could not find the page you were looking for.
            Meanwhile, you may <a href={{ url('administrator') }}>return to dashboard</a> or try using the search form.
        </p>
        @include('admin::errors.search')
    </div>
</div>
@stop

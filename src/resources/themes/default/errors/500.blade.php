@extends('admin::layouts.error')

@section('title')
500 - Internal Server Error | {{ config('site.name') }}
@stop

@section('page-title')
500 - Internal Server Error | {{ config('site.name') }}
@stop

@section('content')
<div class="error-page">
    <h1 class="headline text-danger">500</h1>
    <div class="error-content">
        <h3><i class="fa fa-warning text-danger"></i> Oops! Something went wrong.</h3>
        <p>
            We will work on fixing that right away.
            Meanwhile, you may <a href="{{ url('administrator') }}">return to dashboard</a> or try using the search form.
        </p>
        @include('admin::errors.search')
    </div>
</div>
@stop

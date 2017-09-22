@extends('layouts.master')

@section('title')
    New User | @parent
@stop

@section('page-title')
    @pageHeader('New User', 'Enter user information.', 'fa fa-user-plus')
@stop

@section('content')
    {!! form()->model($user, ['url' => route('administrator.users.store')]) !!}
    @include('administrator.users.partials.form')
    {!! form()->close() !!}
@stop

@push('plugins')
@endpush

@push('scripts')
@endpush

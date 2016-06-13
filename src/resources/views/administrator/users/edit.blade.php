@extends('admin::layouts.master')

@section('title')
Update User | @parent
@stop

@section('page-title')
    @pageHeader('Update User', 'Update user information.', 'fa fa-edit')
@stop

@section('content')
    {!! form()->model($user, ['url' => route('administrator.users.update', $user->id), 'method' => 'put']) !!}
    @include('administrator.users.partials.form')
    {!! form()->close() !!}
@stop

@push('plugins')
@endpush

@push('scripts')
@endpush

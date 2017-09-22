@extends('layouts.master')

@section('page-title')
    @pageHeader('View User Profile', 'There is where you can view a user\'s profile.', 'fa fa-user')
@stop

@section('content')
    <div class="row">
        <div class="col-sm-6">
            @include('administrator.users.partials.profile')
        </div>
    </div>
@stop

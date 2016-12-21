@extends('admin::layouts.master')

@section('title')
    Change Password | @parent
@stop

@section('page-title')
    @pageHeader('Change Password', 'Update password information.', 'fa fa-lock')
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            {!! form()->open(['class' => 'form-horizontal']) !!}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Change Password Form</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="name" class="control-label col-md-3">User</label>
                        <div class="input-control col-md-9">
                            <input type="text" class="form-control input-sm" id="name" value="{{ $user->present()->name  }}"
                                   readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="control-label col-md-3">E-mail</label>
                        <div class="input-control col-md-9">
                            <input type="text" class="form-control input-sm" id="email" value="{{ $user->email  }}"
                                   readonly>
                        </div>
                    </div>

                    <div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!}">
                        <label for="password"
                               class="control-label col-md-3">
                            Password
                        </label>
                        <div class="input-control col-md-9">
                            <input type="password" class="form-control input-sm" name="password" id="password"
                                   placeholder="Enter password here">
                            {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <div class="form-group {!! $errors->has('password_confirmation') ? 'has-error' : '' !!}">
                        <label for="password"
                               class="control-label col-md-3">
                            Confirm Password
                        </label>
                        <div class="input-control col-md-9">
                            <input type="password" class="form-control input-sm" name="password_confirmation"
                                   id="password_confirmation" placeholder="Confirm Password">
                            {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    <a href="{{ route('administrator.users.index') }}" class="btn btn-default">Cancel</a>
                    <input type="submit" class="btn btn-success" value="Save Changes"/>
                </div>
            </div>
            {!! form()->close() !!}
        </div>
    </div>
@stop

@push('plugins')
@endpush

@push('scripts')
@endpush


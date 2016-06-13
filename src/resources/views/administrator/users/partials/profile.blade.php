<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-credit-card"></i> User Information</h3>
    </div>
    <div class="box-body">
        @include('administrator.users.partials.account')
    </div>
    <div class="box-footer">
        <div class="pull-right">
            <a href="{!! route('administrator.users.edit', $user->id) !!}" class="btn btn-sm btn-primary btn-raised ripple-effect">Edit Information</a>
            <a href="{!! route('administrator.users.password', $user->id) !!}" class="btn btn-sm btn-warning btn-raised ripple-effect">Change Password</a>
        </div>
    </div>
</div>

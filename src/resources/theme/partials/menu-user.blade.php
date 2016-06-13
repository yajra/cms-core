<ul class="nav navbar-nav">
    <li>
        <a href="{{url('/')}}"
           target="_blank"
           title="Preview {{config('site.name')}}">
            {{config('site.name')}} <i class="fa fa-rocket"></i>
        </a>
    </li>
    <!-- Notifications: style can be found in dropdown.less -->
    <li class="dropdown notifications-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
            <span class="label label-warning notifications-menu-count">0</span>
        </a>
        <ul class="dropdown-menu">
            <li class="header">You have 0 flash {{ str_plural('notification', 0) }}</li>
            <li class="lists">
                <ul class="menu"></ul>
            </li>
        </ul>
    </li>

    <!-- User Account: style can be found in dropdown.less -->
    <li class="dropdown user user-menu">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="fa fa-user"></span> {{ currentUser()->present()->name }}   <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li class="user-header">
                {{ html()->image(
                    currentUser()->present()->avatar ,
                    'alt',
                    array( 'class' => 'img-circle', 'width' => 70, 'height' => 70 ))
                }}
                <p>
                    {{ currentUser()->present()->name }}
                    <small>Member since: {{ currentUser()->present()->createdAt }}</small>
                </p>
            </li>

            <!-- Menu Body -->
            <li class="user-body">
                <a href="{{ url('/administrator') }}" class="btn btn-default btn-block">Dashboard</a>
            </li>

            <!-- Menu Footer-->
            <li class="user-footer">
                <div class="pull-left">
                    <a href="{{ route('administrator.profile.edit') }}" class="btn btn-default"><i class="fa fa-cogs"></i> Profile</a>
                </div>
                <div class="pull-right">
                    <a href="{{ url('/administrator/logout') }}" class="btn btn-default">
                        <i class="fa fa-sign-out"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
    </li>
</ul>

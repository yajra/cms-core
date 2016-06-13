<div class="row">
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ \Yajra\CMS\Entities\Article::count() }}</h3>

                <p>Articles</p>
            </div>
            <div class="icon">
                <i class="fa fa-files-o"></i>
            </div>
            <a href="{{ route('administrator.articles.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ \Yajra\CMS\Entities\Category::root()->descendants()->count() }}</h3>

                <p>Categories</p>
            </div>
            <div class="icon">
                <i class="fa fa-folder-open"></i>
            </div>
            <a href="{{ route('administrator.categories.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ \Yajra\CMS\Entities\Widget::query()->withoutGlobalScope('menu_assignment')->count() }}</h3>

                <p>Widgets</p>
            </div>
            <div class="icon">
                <i class="fa fa-plug"></i>
            </div>
            <a href="{{ route('administrator.widgets.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ \Yajra\CMS\Entities\Article::sum('hits') }}</h3>

                <p>Article View Hits</p>
            </div>
            <div class="icon">
                <i class="fa fa-eye"></i>
            </div>
            <a href="{{ route('administrator.articles.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Users</span>
                <span class="info-box-number">{{ \App\User::count() }}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-key"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Permissions</span>
                <span class="info-box-number">{{ \Yajra\Acl\Models\Permission::count() }}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-shield"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Roles</span>
                <span class="info-box-number">{{ \Yajra\Acl\Models\Role::count() }}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-link"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Menu</span>
                <span class="info-box-number">{{ \Yajra\CMS\Entities\Menu::root()->descendants()->count() }}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>

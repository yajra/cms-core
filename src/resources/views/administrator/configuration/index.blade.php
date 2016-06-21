@extends('admin::layouts.master')

@section('title')
    Global Configuration | @parent
@stop

@push('styles')
<style>
    .list-group-padding {
        padding-left: 10px !important;
    }

    a.disabled {
        pointer-events: none;
    }

    .table-container {
        margin-top: 3px !important;
    }

    .select2-container{
        width: 100% !important;
    }
</style>
@endpush

@section('page-title')
    @pageHeader('Global Configuration', 'Manage Site Configurations.', 'fa fa-globe')
@stop

@section('content')
    <div class="row" id="config-container">
        <div class="col-md-3">
            <!-- Site Links -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <p class="text-muted text-center">{!! $configuration->key("site.name") !!}</p>
                    <ul class="list-group list-group-unbordered">
                        <li id="list-group-site-mgmt" class="list-group-item list-group-padding">
                            <a href="javascript:void(0)" @click="checkTab('site-mgmt')">
                            <i class="fa fa-cog"></i>&nbsp;Site Management
                            </a>
                        </li>
                        <li id="list-group-app-env" class="list-group-item list-group-padding">
                            <a href="javascript:void(0)" @click="checkTab('app-env')">
                            <i class="fa fa-laptop"></i>&nbsp;Application Environment
                            </a>
                        </li>
                        <li id="list-group-asset-mgmt" class="list-group-item list-group-padding">
                            <a href="javascript:void(0)" @click="checkTab('asset-mgmt')">
                            <i class="fa fa-magic"></i>&nbsp;Asset Management
                            </a>
                        </li>
                        <li id="list-group-db-conn" class="list-group-item list-group-padding">
                            <a href="javascript:void(0)" @click="checkTab('db-conn')">
                            <i class="fa fa-database"></i>&nbsp;Database Connection
                            </a>
                        </li>
                        <li id="list-group-mail-driver" class="list-group-item list-group-padding">
                            <a href="javascript:void(0)" @click="checkTab('mail-driver')">
                            <i class="fa fa-envelope"></i>&nbsp;Mail Driver
                            </a>
                        </li>
                        <li id="list-group-cache-store" class="list-group-item list-group-padding">
                            <a href="javascript:void(0)" @click="checkTab('cache-store')">
                            <i class="fa fa-cloud-download"></i>&nbsp;Cache Store
                            </a>
                        </li>
                        <li id="list-group-session-driver" class="list-group-item list-group-padding">
                            <a href="javascript:void(0)" @click="checkTab('session-driver')">
                            <i class="fa fa-comment-o"></i>&nbsp;Session Driver
                            </a>
                        </li>
                        <li id="list-group-file-system" class="list-group-item list-group-padding">
                            <a href="javascript:void(0)" @click="checkTab('file-system')">
                            <i class="fa fa-briefcase"></i>&nbsp;File System
                            </a>
                        </li>
                    </ul>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li id="site-mgmt" style="margin: 0px 0px -2px;">
                        <a class="hide" data-toggle="tab" href="tab-site-mgmt">
                            <i class="fa fa-cog"></i>&nbsp;Site Management
                        </a>
                    </li>
                    <li id="asset-mgmt" style="margin: 0px 0px -2px;">
                        <a class="hide" data-toggle="tab" href="tab-asset-mgmt">
                            <i class="fa fa-magic"></i>&nbsp;Asset Management
                        </a>
                    </li>
                    <li id="app-env" style="margin: 0px 0px -2px;">
                        <a class="hide" href="#tab-app-env" data-toggle="tab">
                            <i class="fa fa-laptop"></i>&nbsp;Application Environment
                        </a>
                    </li>
                    <li id="db-conn" style="margin: 0px 0px -2px;">
                        <a class="hide" href="#tab-db-conn" data-toggle="tab">
                            <i class="fa fa-database"></i>&nbsp;Database Connection
                        </a>
                    </li>
                    <li id="mail-driver" style="margin: 0px 0px -2px;">
                        <a class="hide" href="#tab-mail-driver" data-toggle="tab">
                            <i class="fa fa-envelope"></i>&nbsp;Mail Driver
                        </a>
                    </li>
                    <li id="cache-store" style="margin: 0px 0px -2px;">
                        <a class="hide" href="#tab-cache-store" data-toggle="tab">
                            <i class="fa fa-cloud-download"></i>&nbsp;Cache Store
                        </a>
                    </li>
                    <li id="session-driver" style="margin: 0px 0px -2px;">
                        <a class="hide" href="#tab-session-driver" data-toggle="tab">
                            <i class="fa fa-comment-o"></i>&nbsp;Session Driver
                        </a>
                    </li>
                    <li id="file-system" style="margin: 0px 0px -2px;">
                        <a class="hide" href="#tab-file-system" data-toggle="tab">
                            <i class="fa fa-briefcase"></i>&nbsp;File System
                        </a>
                    </li>
                </ul>

                <div class="tab-content padding-0">
                    <div class="tab-pane hide" id="tab-site-mgmt">
                        <form method="POST" v-on:submit.prevent="onSubmit(this.site, 'site management')">
                            <div class="box box-solid">
                                <div class="box-body">
                                    @include('administrator.configuration.partials.form.site-management')
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary text-bold">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane hide" id="tab-asset-mgmt">
                        <form method="POST" v-on:submit.prevent="onSubmit(this.asset, 'asset management')">
                            <div class="box box-solid">
                                <div class="box-body">
                                    @include('administrator.configuration.partials.form.asset-management')
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary text-bold">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane hide" id="tab-app-env">
                        <form method="POST" v-on:submit.prevent="onSubmit(this.app, 'application environment')">
                            <div class="box box-solid">
                                <div class="box-body">
                                    @include('administrator.configuration.partials.form.app-environment')
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary text-bold">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane hide" id="tab-db-conn">
                        <form method="POST" v-on:submit.prevent="onSubmit(this.database, ''database connection)">
                            <div class="box box-solid">
                                <div class="box-body">
                                    @include('administrator.configuration.partials.form.database-connection')
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary text-bold">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane hide" id="tab-mail-driver">
                        <form method="POST" v-on:submit.prevent="onSubmit(this.mail, 'mail driver')">
                            <div class="box box-solid">
                                <div class="box-body">
                                    @include('administrator.configuration.partials.form.mail-driver')
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary text-bold">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane hide" id="tab-cache-store">
                        <form method="POST" v-on:submit.prevent="onSubmit(this.cache, 'cache setup')">
                            <div class="box box-solid">
                                <div class="box-body">
                                    @include('administrator.configuration.partials.form.cache-store')
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary text-bold">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane hide" id="tab-session-driver">
                        <form method="POST" v-on:submit.prevent="onSubmit(this.session, 'session driver')">
                            <div class="box box-solid">
                                <div class="box-body">
                                    @include('administrator.configuration.partials.form.session-driver')
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary text-bold">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane hide" id="tab-file-system">
                        <form method="POST" v-on:submit.prevent="onSubmit(this.filesystems, 'file system')">
                            <div class="box box-solid">
                                <div class="box-body">
                                    @include('administrator.configuration.partials.form.file-system')
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary text-bold">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
            </div><!-- /.nav-tabs-custom -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@stop

@push('scripts')
<script type="text/javascript">
    new Vue({
        el: '#config-container',
        ready: function () {
            var that = this;

            // Focus tab depends on url active.
            if (window.location.hash) {
                localStorage.activeTab = window.location.hash.substring(1).replace("setup-", "");
                window.location = '#setup-' + localStorage.activeTab;
                this.checkTab(localStorage.activeTab);
            } else {
                localStorage.activeTab = 'site-mgmt';
                this.checkTab(localStorage.activeTab);
            }

            $('#app_debug').on('change', function () {
                if (that.app.debug == 1) {
                    that.app.debug = 0;
                } else {
                    that.app.debug = 1;
                }
            });

            $('#app_debugbar').on('change', function () {
                if (that.app.debugbar == 1) {
                    that.app.debugbar = 0;
                } else {
                    that.app.debugbar = 1;
                }
            });

            // Global config change container on select database type.
            $('#default-db').on('change', function () {
                $('.db-container').removeClass('hide').addClass('hide');
                $('#' + $(this).val() + '-db-container').removeClass('hide');
            });
            // Global config change container on select cache type.
            $('#default-cache').on('change', function () {
                $('.cache-container').removeClass('hide').addClass('hide');
                $('#' + $(this).val() + '-cache-container').removeClass('hide');
            });
            // Global config change container on select file system type.
            $('#default-filesytem').on('change', function () {
                $('.filesystem-container').removeClass('hide').addClass('hide');
                $('#' + $(this).val() + '-filesystem-container').removeClass('hide');
            });

            $('#css-assets-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/administrator/configuration/assets',
                    type: "get",
                    data: {
                        type: "css"
                    }
                },
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'url', name: 'url'},
                ],
                initComplete: function () {

                }
            });

            // select2 on change. Set vue object value.
            var $eventSelect = $('select');
            $eventSelect.on("change", function () {
                var select = $(this).attr('config');
                var selected = $(this).val();

                switch (select) {
                    case 'site.admin_theme':
                        that.site.admin_theme = selected;
                        break;
                    case 'app.env':
                        that.app.env = selected;
                        break;
                    case 'app.timezone':
                        that.app.timezone = selected;
                        break;
                    case 'app.locale':
                        that.app.locale = selected;
                        break;
                    case 'app.log':
                        that.app.log = selected;
                        break;
                    case 'database.default':
                        that.database.default = selected;
                        break;
                    case 'mail.driver':
                        that.mail.driver = selected;
                        break;
                    case 'cache.default':
                        that.cache.default = selected;
                        break;
                    case 'session.driver':
                        that.session.driver = selected;
                        break;
                    case 'filesystems.default':
                        that.filesystems.default = selected;
                    case 'asset.default':
                        that.asset.default = selected;
                        break;
                    case 'newasset.type':
                        that.newasset.type = selected;
                        break;
                    case 'newasset.category':
                        that.newasset.category = selected;
                            if(selected == 'cdn'){
                                $('#asset-url-label').text('URL');
                            } else{
                                $('#asset-url-label').text('Path');
                            }
                        break;
                }
            });
        },
        data: {
            'newasset': {
                'name': '',
                'type': '',
                'category': '',
                'url': '',
            }
        },
        methods: {
            checkTab: function (selectedTab) {
                window.location = '#setup-' + selectedTab;
                var activeTab = $('.nav-tabs .active').attr('id');
                $('#' + activeTab).hide();
                $('#' + activeTab).removeClass('active');
                $('#tab-' + activeTab).hide();
                $('#tab-' + activeTab).removeClass('active');
                $('#' + selectedTab).addClass('active');
                $('#' + selectedTab).show();
                $('#tab-' + selectedTab).show();
                $('#tab-' + selectedTab).addClass('active');
                $('#' + selectedTab + ' a').removeClass('hide');
                $('#tab-' + selectedTab).removeClass('hide');
                $('.list-group-item').css('background', '#FFFFFF');
                $('.list-group-item a').css('color', '#3c8dbc');
                $('#list-group-' + selectedTab).css('background', '#F5F5F5');
                $('#list-group-' + selectedTab + ' a').css('color', '#2f353b');
                localStorage.activeTab = selectedTab;
                $('.select2-container').css('width', '100%');
            },
            onSubmit: function (values, config_title) {
                swal({
                            title: "Are you sure?",
                            text: "Save and update site configuration.",
                            type: "info",
                            showCancelButton: true,
                            closeOnConfirm: false,
                            showLoaderOnConfirm: true,
                        },
                        function () {
                            Vue.http.post('/administrator/configuration', values).then(function (response) {
                                swal({
                                    title: "Updated!",
                                    type: "success",
                                    text: "Your " + config_title + " configuration successfully updated! <br><small>You may need to refresh the page to reflect some changes.</small>",
                                    html: true
                                });
                            }, function (response) {
                                // error callback
                            });
                        });
            },
            showJsAssets: function () {
                $('#js-assets-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '/administrator/configuration/assets',
                        type: "get",
                        data: {
                            type: "js"
                        }
                    },
                    columns: [
                        {data: 'name', name: 'name'},
                        {data: 'url', name: 'url'},
                    ],
                    initComplete: function () {
                        $('.dataTables_filter input').attr('placeholder', 'Quick search');
                    }
                });
            },
            showModal: function (name) {
                $('#' + name).modal('show');
            }

        }
    });
</script>
@endpush
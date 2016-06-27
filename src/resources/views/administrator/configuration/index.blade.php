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

    .select2-container {
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
                        @include('administrator.configuration.partials.list-item',['title' => 'Site Management','key'=>'site-mgmt','icon' => 'fa-cog'])
                        @include('administrator.configuration.partials.list-item',['title' => 'Application Environment','key'=>'app-env','icon' => 'fa-laptop'])
                        @include('administrator.configuration.partials.list-item',['title' => 'Asset Management','key'=>'asset-mgmt','icon' => 'fa-magic'])
                        @include('administrator.configuration.partials.list-item',['title' => 'Database Connection','key'=>'db-conn','icon' => 'fa-database'])
                        @include('administrator.configuration.partials.list-item',['title' => 'Mail Driver','key'=>'mail-driver','icon' => 'fa-envelope'])
                        @include('administrator.configuration.partials.list-item',['title' => 'Cache Store','key'=>'cache-store','icon' => 'fa-cloud-download'])
                        @include('administrator.configuration.partials.list-item',['title' => 'Session Driver','key'=>'session-driver','icon' => 'fa-comment-o'])
                        @include('administrator.configuration.partials.list-item',['title' => 'File System','key'=>'file-system','icon' => 'fa-briefcase'])
                    </ul>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    @include('administrator.configuration.partials.tab-list-item',['title' => 'Site Management','key' => 'site-mgmt', 'icon' =>'fa-cog'])
                    @include('administrator.configuration.partials.tab-list-item',['title' => 'Asset Management','key' => 'asset-mgmt', 'icon' =>'fa-magic'])
                    @include('administrator.configuration.partials.tab-list-item',['title' => 'Application Environment','key' => 'app-env', 'icon' =>'fa-laptop'])
                    @include('administrator.configuration.partials.tab-list-item',['title' => 'Database Connection','key' => 'db-conn', 'icon' =>'fa-database'])
                    @include('administrator.configuration.partials.tab-list-item',['title' => 'Mail Driver','key' => 'mail-driver', 'icon' =>'fa-envelope'])
                    @include('administrator.configuration.partials.tab-list-item',['title' => 'Cache Store','key' => 'cache-store', 'icon' =>'fa-cloud-download'])
                    @include('administrator.configuration.partials.tab-list-item',['title' => 'Session Driver','key' => 'session-driver', 'icon' =>'fa-comment-o'])
                    @include('administrator.configuration.partials.tab-list-item',['title' => 'File System','key' => 'file-system', 'icon' =>'fa-briefcase'])
                </ul>

                <div class="tab-content padding-0">
                    @include('administrator.configuration.partials.tab-content', ['key' => 'site-mgmt', 'vueKey' => 'this.site','swalTitle'=>'site management','form'=>'administrator.configuration.partials.form.site-management'])
                    @include('administrator.configuration.partials.tab-content', ['key' => 'asset-mgmt', 'vueKey' => 'this.asset','swalTitle'=>'asset management','form'=>'administrator.configuration.partials.form.asset-management'])
                    @include('administrator.configuration.partials.tab-content', ['key' => 'app-env', 'vueKey' => 'this.app','swalTitle'=>'application environment','form'=>'administrator.configuration.partials.form.app-environment'])
                    @include('administrator.configuration.partials.tab-content', ['key' => 'db-conn', 'vueKey' => 'this.database','swalTitle'=>'database connection','form'=>'administrator.configuration.partials.form.database-connection'])
                    @include('administrator.configuration.partials.tab-content', ['key' => 'mail-driver', 'vueKey' => 'this.mail','swalTitle'=>'mail driver','form'=>'administrator.configuration.partials.form.mail-driver'])
                    @include('administrator.configuration.partials.tab-content', ['key' => 'cache-store', 'vueKey' => 'this.cache','swalTitle'=>'cache setup','form'=>'administrator.configuration.partials.form.cache-store'])
                    @include('administrator.configuration.partials.tab-content', ['key' => 'session-driver', 'vueKey' => 'this.session','swalTitle'=>'session driver','form'=>'administrator.configuration.partials.form.session-driver'])
                    @include('administrator.configuration.partials.tab-content', ['key' => 'file-system', 'vueKey' => 'this.filesystems','swalTitle'=>'file system','form'=>'administrator.configuration.partials.form.file-system'])
                </div><!-- /.tab-content -->
            </div><!-- /.nav-tabs-custom -->
        </div><!-- /.col -->
        @include('administrator.configuration.modal.new-asset')
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

            // File assets datatable.
            that.asset.assetDt = $('#css-assets-table').DataTable({
                order: [[1, 'asc']],
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/administrator/configuration/assets/' + that.asset.default,
                    type: "get",
                },
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'type', name: 'type'},
                    {data: 'url', name: 'url'},
                    {data: 'action', name: 'action', 'searchable': false, 'orderable': false, 'width': '67px'},
                ],
                drawCallback() {
                    $('.btn-delete-asset').on('click', function () {
                        var assetId = $(this).attr('id');
                        swal({
                            title: "Are you sure?",
                            text: "Delete selected asset.",
                            type: "info",
                            showCancelButton: true,
                            closeOnConfirm: false,
                            showLoaderOnConfirm: true,
                        },
                        function () {
                            Vue.http.post('/administrator/configuration/asset/delete/' + assetId).then(function (response) {
                                that.asset.assetDt.ajax.url('/administrator/configuration/assets/' + that.asset.default).load();
                                swal({
                                    title: "Success!",
                                    type: "success",
                                    text: "Asset successfully deleted.",
                                    html: true
                                });
                            });
                        });
                    });

                    $('.btn-edit-asset').on('click', function () {
                        $.blockUI();
                        var assetId = $(this).attr('id');
                        Vue.http.get('/administrator/configuration/asset/edit/' + assetId).then(function(response) {
                            that.editasset.name = response.data.name;
                            that.editasset.url = response.data.url;
                            $("#edit-asset-type").val(response.data.type).change();
                            $("#edit-asset-category").val(response.data.category).change();
                            $('#edit-asset-modal').modal('show');
                            $.unblockUI();
                        });
                    });
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
                        that.asset.assetDt.ajax.url('/administrator/configuration/assets/' + selected).load();
                        break;
                    case 'newasset.type':
                        that.newasset.type = selected;
                        break;
                    case 'editasset.type':
                        that.editasset.type = selected;
                        break;
                    case 'newasset.category':
                        that.newasset.category = selected;
                        if (selected == 'cdn') {
                            $('#asset-url-label').text('URL');
                        } else {
                            $('#asset-url-label').text('Path');
                        }
                        break;
                    case 'editasset.category':
                        that.editasset.category = selected;
                        if (selected == 'cdn') {
                            $('#edit-asset-url-label').text('URL');
                        } else {
                            $('#edit-asset-url-label').text('Path');
                        }
                        break;
                }
            });
        },
        data: {
            'assetDt': '',
            'newasset': {
                'name': '',
                'type': '',
                'category': '',
                'url': '',
            },
            'editasset':{
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
            showModal: function (name) {
                $('#' + name).modal('show');
            },
            submitNewAsset: function (values) {
                var that = this;
                swal({
                    title: "Are you sure?",
                    text: "Save and add new asset.",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                },
                function () {
                    Vue.http.post('/administrator/configuration/asset/store', values).then(function (response) {
                        $('#new-asset-modal').modal('hide');
                        that.newasset.name = '';
                        that.newasset.url = '';
                        swal({
                            title: "Success!",
                            type: "success",
                            text: "Asset successfully added.",
                            html: true
                        });
                        that.asset.assetDt.ajax.url('/administrator/configuration/assets/' + that.asset.default).load();
                    }, function (response) {
                        if (response.data.name) {
                            var textwarning = response.data.name;
                        } else if (response.data.url) {
                            var textwarning = response.data.url;
                        }
                        sweetAlert("Oops...", textwarning, "error");
                    });
                });
            },
        }
    });
</script>
@endpush
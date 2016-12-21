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
    <div class="row" id="config-app">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <p class="text-muted text-center">{!! config("site.name") !!}</p>
                    <ul class="list-group list-group-unbordered">
                        @foreach($config as $c)
                            @include('administrator.configuration.partials.list-item', $c)
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    @foreach($config as $c)
                        @include('administrator.configuration.partials.tab-list-item', $c)
                    @endforeach
                </ul>

                <div class="tab-content padding-0">
                    @foreach($config as $c)
                        @include('administrator.configuration.partials.tab-content', $c)
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
<script type="text/javascript">
    new Vue({
        el: '#config-app',
        data: {
            configs: ['app', 'database', 'site', 'mail', 'cache', 'session', 'filesystems'],
            tabs: [],
            app: {},
            database: {
                connections: {
                    mysql: {},
                    oracle: {},
                    pgsql: {},
                    sqlite: {},
                }
            },
            site: {},
            mail: {},
            cache: {
                stores: {
                    apc: {},
                    array: {},
                    database: {},
                    file: {},
                    memcached: {
                        servers: [
                            {host: '', port: '', weight: ''},
                            {host: '', port: '', weight: ''},
                        ]
                    },
                    redis: {}
                }
            },
            session: {},
            filesystems: {
                disks: {
                    local: {},
                    public: {},
                    s3: {}
                }
            }
        },
        mounted: function () {
            this.fetchConfigs();
            // Focus tab depends on url active.
            if (window.location.hash) {
                localStorage.activeTab = window.location.hash.substring(1).replace("setup-", "");
                window.location = '#setup-' + localStorage.activeTab;
                this.checkTab(localStorage.activeTab);
            } else {
                localStorage.activeTab = 'site';
                this.checkTab(localStorage.activeTab);
            }
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
            // Global config change container on select database type.
            $('#default-db').on('change', function () {
                $('.db-container').removeClass('hide').addClass('hide');
                $('#' + $(this).val() + '-db-container').removeClass('hide');
            });
        },
        methods: {
            fetchConfigs: function () {
                this.configs.forEach(function (config) {
                    this.fetchConfig(config);
                }.bind(this));
            },
            fetchConfig: function (key) {
                axios.get(YajraCMS.adminPath + '/configuration/' + key).then(function (response) {
                    this.$set(this, key, response.data);
                }.bind(this));
            },
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
            storeConfig: function (config) {
                var vm = this;
                swal({
                        title: "Are you sure?",
                        text: "Save and update site configuration.",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    },
                    function () {
                        var json = {};
                        json.config = config;
                        json.data = vm[config];
                        axios.post(YajraCMS.adminPath + '/configuration', json).then(function (response) {
                            pushNotification(response.data);
                        });
                    });
            }
        }
    });
</script>
@endpush

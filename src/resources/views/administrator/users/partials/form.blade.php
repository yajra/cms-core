<div class="row">
    <div class="col-md-12">
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 style="color: #505b69;" class="box-title">
                                {{trans('cms::user.form.title')}}
                                <small>
                                    {{trans('cms::user.form.help')}}
                                </small></h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-7">
                                    @include('administrator.users.partials.forms.account')
                                </div>
                                <div class="col-md-5">
                                    @include('administrator.users.partials.forms.roles')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

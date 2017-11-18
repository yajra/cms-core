<div class="nav-tabs-custom" style="margin-top: 30px">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#menu-details" data-toggle="tab">
            <i class="fa fa-info"></i> {{trans('cms::menu.tab.details')}}</a>
        </li>
        <li><a href="#page-display" data-toggle="tab">
            <i class="fa fa-sign-out"></i> {{trans('cms::menu.tab.display')}}</a>
        </li>
        <li><a href="#metadata" data-toggle="tab">
            <i class="fa fa-reorder"></i> {{trans('cms::menu.tab.metadata')}}</a>
        </li>
        <li><a href="#menu-permissions" data-toggle="tab">
            <i class="fa fa-lock"></i> {{trans('cms::menu.tab.permission')}}</a>
        </li>
        <li><a href="#widgets" data-toggle="tab">
            <i class="fa fa-plug"></i> {{trans('cms::menu.tab.widget')}}</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="active tab-pane" id="menu-details">
            <div class="content no-padding">
                @include('administrator.navigation.menu.partials.form.details')
            </div>
        </div>
        <div class="tab-pane" id="page-display">
            <div class="content no-padding">
                @include('administrator.navigation.menu.partials.form.display')
            </div>
        </div>
        <div class="tab-pane" id="metadata">
            <div class="content no-padding">
                @include('administrator.navigation.menu.partials.form.metadata')
            </div>
        </div>
        <div class="tab-pane" id="menu-permissions">
            <div class="content no-padding">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ hasError('authorization') }}">
                            <label class="form-label-style" for="authorization">
                                {{trans('cms::menu.field.authorization')}}
                                @tooltip('cms::menu.tooltip.authorization')
                            </label>

                            {{ form()->select('authorization', ['can' => trans('cms::menu.authorization.can'), 'canAtLeast' => trans('cms::menu.authorization.canAtLeast')], null, ['class' => 'form-control']) }}
                            @error('authorization')
                        </div>
                    </div>
                </div>
                @include('administrator.partials.permissions', ['model' => $menu])
            </div>
        </div>
        <div class="tab-pane" id="widgets">
            @include('administrator.navigation.menu.partials.form.widgets')
        </div>
    </div>
</div>

@include('administrator.navigation.menu.partials.modal.extensions')

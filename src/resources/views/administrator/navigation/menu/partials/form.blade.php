<input type="hidden" id="menu-id" value="{{ $menu->id }}">
<div class="nav-tabs-custom" style="margin-top: 30px">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#menu-details" data-toggle="tab">
            <i class="fa fa-info"></i> {{trans('menu.tab.details')}}</a>
        </li>
        <li><a href="#link-type" data-toggle="tab">
            <i class="fa fa-code-fork"></i> {{trans('menu.tab.link')}}</a>
        </li>
        <li><a href="#page-display" data-toggle="tab">
            <i class="fa fa-sign-out"></i> {{trans('menu.tab.display')}}</a>
        </li>
        <li><a href="#metadata" data-toggle="tab">
            <i class="fa fa-reorder"></i> {{trans('menu.tab.metadata')}}</a>
        </li>
        <li><a href="#menu-permissions" data-toggle="tab">
            <i class="fa fa-lock"></i> {{trans('menu.tab.permission')}}</a>
        </li>
        <li><a href="#widgets" data-toggle="tab">
            <i class="fa fa-plug"></i> {{trans('menu.tab.widget')}}</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="active tab-pane" id="menu-details">
            <div class="content no-padding">
                @include('administrator.navigation.menu.partials.form.details')
            </div>
        </div>
        <div class="tab-pane" id="link-type">
            <div class="content no-padding">
                @include('administrator.navigation.menu.partials.form.link')
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
                        <div class="form-group {!! $errors->has('authorization') ? 'has-error' : '' !!}">
                            <label class="form-label-style" for="authorization">
                                {{trans('menu.field.authorization')}}
                                @tooltip('menu.tooltip.authorization')
                            </label>

                            {{ form()->select('authorization', ['can' => trans('menu.authorization.can'), 'canAtLeast' => trans('menu.authorization.canAtLeast')], null, ['class' => 'form-control']) }}
                            {!! $errors->first('authorization', '<span class="help-block">:message</span>') !!}
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

@include('administrator.navigation.menu.partials.modal.types')

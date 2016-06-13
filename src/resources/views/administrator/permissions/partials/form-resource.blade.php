<div class="box box-primary">
    <div class="box-header with-border">
        <h3 style="color: #505b69;" class="box-title">RESOURCE INFORMATION
            <small>
                (please fill up all required fields.)
            </small>
        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {!! $errors->has('resource') ? 'has-error' : '' !!}">
                    <label class="form-label-style" for="resource">Resource Name</label>
                    {!! form()->input('text', 'resource', null, ['id'=>'resource','class'=>'form-control','placeholder'=>'Resource Name']) !!}
                    {!! $errors->first('resource', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 style="color: #505b69;" class="box-title">
                            <i class="fa fa-tag"></i>
                            Attach Roles
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group {!! $errors->has('roles') ? 'has-error' : '' !!}">
                            @foreach($roles->chunk(2) as $chunk)
                                <fieldset>
                                    <div class="row">
                                        @foreach($chunk as $role)
                                            <div class="col-sm-6">
                                                <div class="md-checkbox">
                                                    <input type="checkbox" id="{{$role->id}}" value="{{$role->id}}"
                                                           name="roles[]"
                                                           class="md-check" {!! in_array($role->id, $permission->roles()->select('roles.id')->lists('id')->all()) ? 'checked' : '' !!}
                                                    >
                                                    <label for="{{$role->id}}">{{$role->name}}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </fieldset>
                            @endforeach
                            {!! $errors->first('permissions', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <div class="form-actions">
            <a href="{{ route('administrator.permissions.index') }}" class="btn btn-warning"
               style="font-weight: bold">Back</a>
            <button type="reset" class="btn btn-default text-bold">Reset</button>
            <button type="submit" class="btn btn-primary text-bold">Save Changes</button>
        </div>
    </div>
</div>
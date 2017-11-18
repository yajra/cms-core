<div class="box box-default">
    <div class="box-header with-border">
        <h3 style="color: #505b69;" class="box-title">
            <i class="fa fa-tag"></i>
            Attach Roles
        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body" style="display: inline-block; width: 100%">
        <div class="form-group {{ hasError('roles') }}">
            <div class="input-control col-md-12">
                @foreach($roles->chunk(2) as $chunk)
                    <fieldset>
                        <div class="row" style="margin-bottom: 13px">
                            @foreach($chunk as $role)
                                <div class="col-sm-6">
                                    <div class="md-checkbox">
                                        <input type="checkbox" id="{{$role->id}}" value="{{$role->id}}" name="roles[]"
                                               class="md-check" {!! in_array($role->id, $permission->roles()->select('roles.id')->pluck('id')->all()) ? 'checked' : '' !!}>
                                        <label for="{{$role->id}}">
                                            {{$role->name}}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </fieldset>
                @endforeach
                @error('roles')
            </div>
        </div>
    </div>
</div>

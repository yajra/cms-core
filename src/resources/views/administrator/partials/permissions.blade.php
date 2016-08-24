<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title" style="font-size: 15px;">
            <i class="fa fa-tag"></i>
            {{trans('cms::permission.attached')}}
            {!! $errors->first('permissions', '<small class="help-inline text-red">:message</small>') !!}
        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-toggle="tooltip"
                    data-title="Uncheck All" data-widget="uncheck">
                <i class="fa fa-square-o"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-toggle="tooltip"
                    data-title="Check All" data-widget="check">
                <i class="fa fa-check-square-o"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body {!! $errors->has('permissions') ? 'has-error' : '' !!}">
        @foreach($permissions->groupBy('resource')->chunk(2) as $chunks)
            <div class="row">
            @foreach($chunks as $resource)
                <div class="col-md-6">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title" style="font-size: 14px; color: #3c8dbc">
                                <i class="fa fa-archive"></i> &nbsp;{{ $resource[0]->resource }} Resource
                            </h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-toggle="tooltip"
                                        data-title="Uncheck All" data-widget="uncheck">
                                    <i class="fa fa-square-o"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-toggle="tooltip"
                                        data-title="Check All" data-widget="check">
                                    <i class="fa fa-check-square-o"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            @foreach($resource->chunk(4) as $chunk)
                                <div class="row">
                                    @foreach($chunk as $permission)
                                        <div class="col-sm-3">
                                            <div class="md-checkbox">
                                                <input type="checkbox" id="{{$permission->id}}" value="{{$permission->id}}"
                                                       name="permissions[]"
                                                       class="md-check" {!! in_array($permission->id, $model->permissions()->select('permissions.id')->pluck('id')->all()) ? 'checked' : '' !!}>
                                                <label for="{{$permission->id}}" style="font-weight: normal">
                                                    &nbsp;{{$permission->name}}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        @endforeach
    </div>
</div>

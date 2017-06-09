@if($enabled)
    <button class="btn btn-xs btn-block btn-default text-yellow"
            data-ajax="{{route('administrator.extension.store', ['id' => $id])}}">
        <i class="fa fa-times"></i>
        {{trans('cms::extension.button.disable')}}
    </button>
@else
    <button class="btn btn-xs btn-block btn-default text-green"
            data-ajax="{{route('administrator.extension.store', ['id' => $id])}}">
        <i class="fa fa-check"></i>
        {{trans('cms::extension.button.enable')}}
    </button>
@endif
@if(! $protected)
    <button class="btn btn-xs btn-block btn-default text-red btn-delete"
            data-remote="{{route('administrator.extension.destroy', $id)}}">
        <i class="fa fa-trash"></i>
        {{trans('cms::extension.button.uninstall')}}
    </button>
@endif

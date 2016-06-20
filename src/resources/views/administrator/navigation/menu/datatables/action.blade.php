<div class="btn-group">
    <a href="{!! route('administrator.navigation.menu.edit', [$navigation_id, $id]) !!}"
       class="btn btn-xs btn-default"
       data-toggle="tooltip"
       data-title="{{trans('cms::button.edit')}}"
       data-container="body"
    >
        &nbsp;&nbsp;<i class="fa fa-pencil"></i>&nbsp;&nbsp;
    </a>
    <button data-remote="{!! route('administrator.navigation.menu.destroy', [$navigation_id, $id]) !!}"
            class="btn btn-xs btn-delete btn-danger"
            data-toggle="tooltip"
            data-title="{{trans('cms::button.delete')}}"
            data-container="body"
    >
        &nbsp;&nbsp;<i class="fa fa-trash-o"></i>&nbsp;&nbsp;
    </button>
    @if($published)
        <button data-ajax="{!! route('administrator.navigation.menu.publish', [$navigation_id, $id]) !!}"
                class="btn btn-warning btn-xs"
                data-toggle="tooltip"
                data-title="{{trans('cms::button.unpublish')}}"
                data-container="body"
        >
            &nbsp;&nbsp;<i class="fa fa-close"></i>&nbsp;&nbsp;
        </button>
    @else
        <button data-ajax="{!! route('administrator.navigation.menu.publish', [$navigation_id, $id]) !!}"
                class="btn btn-success btn-xs"
                data-toggle="tooltip"
                data-title="{{trans('cms::button.publish')}}"
                data-container="body"
        >
            &nbsp;&nbsp;<i class="fa fa-check-circle"></i>&nbsp;&nbsp;
        </button>
    @endif
</div>

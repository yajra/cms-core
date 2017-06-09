<div class="btn-group">
    <button data-ajax="{!! route('administrator.navigation.menu.publish', [$navigation_id, $id]) !!}"
            class="btn btn-default btn-xs {{ $published ? 'text-green' : 'text-red' }}"
            data-toggle="tooltip"
            data-title="{{ $published ? trans('cms::button.unpublish') : trans('cms::button.publish')}}"
            data-container="body"
    >
        <i class="fa {{ $published ? 'fa-check-circle' : 'fa-close' }}"></i>
    </button>
    <a href="{!! route('administrator.navigation.menu.edit', [$navigation_id, $id]) !!}"
       class="btn btn-xs btn-default"
       data-toggle="tooltip"
       data-title="{{trans('cms::button.edit')}}"
       data-container="body"
    >
        <i class="fa fa-pencil"></i>
    </a>
    <button data-remote="{!! route('administrator.navigation.menu.destroy', [$navigation_id, $id]) !!}"
            class="btn btn-xs btn-delete btn-default text-red"
            data-toggle="tooltip"
            data-title="{{trans('cms::button.delete')}}"
            data-container="body"
    >
        <i class="fa fa-trash-o"></i>
    </button>
</div>

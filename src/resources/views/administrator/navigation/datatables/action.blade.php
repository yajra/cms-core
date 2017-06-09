<div class="btn-group">
    <button data-ajax="{!! route('administrator.navigation.publish', $id) !!}"
            class="btn btn-default btn-xs {{ $published ? 'text-green' : 'text-red' }}"
            data-toggle="tooltip"
            data-title="{{ $published ? trans('cms::button.unpublish') : trans('cms::button.publish')}}"
            data-container="body"
    >
        <i class="fa {{ $published ? 'fa-check-circle' : 'fa-close' }}"></i>
    </button>
    <a href="{!! route('administrator.navigation.menu.index', $id) !!}"
       class="btn btn-xs btn-default text-blue"
       data-toggle="tooltip"
       data-title="Menu Items"
       data-container="body"
    >
        <i class="fa fa-list-alt"></i>
    </a>
    <a href="{!! route('administrator.navigation.edit', $id) !!}"
       class="btn btn-xs btn-default"
       data-toggle="tooltip"
       data-title="{{trans('cms::button.edit')}}"
       data-container="body"
    >
        <i class="fa fa-pencil"></i>
    </a>
    <button data-remote="{!! route('administrator.navigation.destroy', $id) !!}"
            class="btn btn-xs btn-default text-red btn-delete"
            data-toggle="tooltip"
            data-title="{{trans('cms::button.delete')}}"
            data-container="body"
    >
        <i class="fa fa-trash-o"></i>
    </button>
</div>

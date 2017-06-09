<div class="btn-group">
    <button data-ajax="{!! route('administrator.widgets.publish', $id) !!}"
            class="btn btn-default btn-xs {{ $published ? 'text-green' : 'text-red' }}"
            data-toggle="tooltip"
            data-title="{{ $published ? trans('cms::button.unpublish') : trans('cms::button.publish')}}"
            data-container="body"
    >
        <i class="fa {{ $published ? 'fa-check-circle' : 'fa-close' }}"></i>
    </button>
    <a href="{!! route('administrator.widgets.edit', $id) !!}"
       class="btn btn-default btn-xs"
       data-toggle="tooltip"
       data-title="{{trans('cms::button.edit')}}"
       data-container="body"
    >
        <i class="fa fa-pencil"></i>
    </a>
    <button data-remote="{!! route('administrator.widgets.destroy', $id) !!}"
            class="btn btn-default text-red btn-xs btn-delete"
            data-toggle="tooltip"
            data-title="{{trans('cms::button.delete')}}"
            data-container="body"
    >
        <i class="fa fa-trash"></i>
    </button>
</div>

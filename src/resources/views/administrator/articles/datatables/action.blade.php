<div class="btn-group">
    <a href="{!! route('administrator.articles.edit', $id) !!}"
            class="btn btn-xs btn-default"
            data-toggle="tooltip"
            data-title="{{trans('cms::button.edit')}}"
            data-container="body"
    >
        <i class="fa fa-pencil"></i>
    </a>
    <button data-remote="{!! route('administrator.articles.destroy', $id) !!}"
            class="btn btn-xs btn-delete btn-default text-red"
            data-toggle="tooltip"
            data-title="{{trans('cms::button.delete')}}"
            data-container="body"
    >
        <i class="fa fa-trash-o"></i>
    </button>
</div>

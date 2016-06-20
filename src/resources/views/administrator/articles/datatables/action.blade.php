<div class="btn-group">
    <a href="{!! route('administrator.articles.edit', $id) !!}"
       class="btn btn-xs btn-default"
       data-toggle="tooltip"
       data-title="{{trans('cms::button.edit')}}"
       data-container="body"
    >
        &nbsp;&nbsp;<i class="fa fa-pencil"></i>&nbsp;&nbsp;
    </a>
    </a>
    <button data-remote="{!! route('administrator.articles.destroy', $id) !!}"
            class="btn btn-xs btn-delete btn-danger"
            data-toggle="tooltip"
            data-title="{{trans('cms::button.delete')}}"
            data-container="body"
    >
        &nbsp;&nbsp;<i class="fa fa-trash-o"></i>&nbsp;&nbsp;
    </button>
    @if($published)
        <button data-ajax="{!! route('administrator.articles.publish', $id) !!}"
                class="btn btn-warning btn-xs"
                data-toggle="tooltip"
                data-title="{{trans('cms::button.unpublish')}}"
                data-container="body"
        >
            &nbsp;&nbsp;<i class="fa fa-close"></i>&nbsp;&nbsp;
        </button>
    @else
        <button data-ajax="{!! route('administrator.articles.publish', $id) !!}"
                class="btn btn-success btn-xs"
                data-toggle="tooltip"
                data-title="{{trans('cms::button.publish')}}"
                data-container="body"
        >
            &nbsp;&nbsp;<i class="fa fa-check-circle"></i>&nbsp;&nbsp;
        </button>
    @endif
</div>

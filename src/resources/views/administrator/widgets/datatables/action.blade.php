<div class="btn-group">
    <a href="{!! route('administrator.widgets.edit', $id) !!}"
       class="btn btn-default btn-xs"
       data-toggle="tooltip"
       data-title="Edit"
       data-container="body"
    >
        &nbsp;&nbsp;<i class="fa fa-pencil"></i>&nbsp;&nbsp;
    </a>
    <button data-remote="{!! route('administrator.widgets.destroy', $id) !!}"
            class="btn btn-danger btn-xs btn-delete"
            data-toggle="tooltip"
            data-title="Delete"
            data-container="body"
    >
        &nbsp;&nbsp;<i class="fa fa-trash"></i>&nbsp;&nbsp;
    </button>
    @if($published)
        <button data-ajax="{!! route('administrator.widgets.publish', $id) !!}"
                class="btn btn-warning btn-xs"
                data-toggle="tooltip"
                data-title="Unpublish"
                data-container="body"
        >
            &nbsp;&nbsp;<i class="fa fa-close"></i>&nbsp;&nbsp;
        </button>
    @else
        <button data-ajax="{!! route('administrator.widgets.publish', $id) !!}"
                class="btn btn-success btn-xs"
                data-toggle="tooltip"
                data-title="Publish"
                data-container="body"
        >
            &nbsp;&nbsp;<i class="fa fa-check-circle"></i>&nbsp;&nbsp;
        </button>
    @endif
</div>

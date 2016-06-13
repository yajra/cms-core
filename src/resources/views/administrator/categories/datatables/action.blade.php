<div class="btn-group">

    @if($status)
        <button data-ajax="{!! route('administrator.categories.publish', $id) !!}"
                class="btn btn-warning btn-xs"
                data-toggle="tooltip"
                data-title="Unpublish"
                data-container="body"
        >
            &nbsp;&nbsp;<i class="fa fa-close"></i>&nbsp;&nbsp;
        </button>
    @else
        <button data-ajax="{!! route('administrator.categories.publish', $id) !!}"
                class="btn btn-success btn-xs"
                data-toggle="tooltip"
                data-title="Publish"
                data-container="body"
        >
            &nbsp;&nbsp;<i class="fa fa-check-circle"></i>&nbsp;&nbsp;
        </button>
    @endif

    <a href="{!! route('administrator.categories.edit', $id) !!}"
       class="btn btn-xs btn-default"
       data-toggle="tooltip"
       data-title="Edit"
       data-container="body"
    >
        &nbsp;&nbsp;<i class="fa fa-pencil"></i>&nbsp;&nbsp;
    </a>
    </a>
    @if($depth >= 1)
    <button data-remote="{!! route('administrator.categories.destroy', $id) !!}"
            class="btn btn-xs btn-delete btn-danger"
            data-toggle="tooltip"
            data-title="Delete"
            data-container="body"
    >
        &nbsp;&nbsp;<i class="fa fa-trash-o"></i>&nbsp;&nbsp;
    </button>
    @endif
</div>

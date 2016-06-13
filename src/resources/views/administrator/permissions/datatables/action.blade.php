<div class="btn-group">
    <a href="{!! route('administrator.permissions.edit', $id) !!}"
       class="btn btn-default btn-xs"
       data-toggle="tooltip"
       data-title="Edit"
       data-container="body"
    >
        <i class="fa fa-pencil"></i>
    </a>
    @if(! $system)
        <button data-remote="{!! route('administrator.permissions.destroy', $id) !!}"
            class="btn btn-danger btn-xs btn-delete"
            data-toggle="tooltip"
            data-title="Delete"
            data-container="body"
        >
            <i class="fa fa-trash-o"></i>
        </button>
    @endif
</div>

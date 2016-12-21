<div class="btn-group">
    <button type="button"
            class="btn btn-xs btn-primary"
            data-toggle="tooltip"
            data-title="Enable/Disable Module"
            data-ajax="{{route('administrator.modules.toggle', $alias)}}"
    >
        <i class="fa fa-repeat"></i>
    </button>
    <button type="button"
            data-remote="{{route('administrator.modules.destroy', $alias)}}"
            data-toggle="tooltip"
            data-title="Delete Module"
            class="btn btn-xs btn-danger btn-delete"
    >
        <i class="fa fa-trash"></i>
    </button>
</div>

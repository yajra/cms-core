<div class="btn-group">
    <button type="button"
            class="btn btn-xs btn-default {{ $active ? 'text-green' : 'text-red' }}"
            data-toggle="tooltip"
            data-title="{{ $active ? trans('cms::button.unpublish') : trans('cms::button.publish') }}"
            data-ajax="{{route('administrator.modules.toggle', $alias)}}"
    >
        <i class="fa fa-{{ $active ? 'check' : 'close' }}"></i>
    </button>
    @if (isset($protected) && ! $protected)
        <button type="button"
                data-remote="{{route('administrator.modules.destroy', $alias)}}"
                data-toggle="tooltip"
                data-title="{{trans('cms::button.delete')}}"
                class="btn btn-xs btn-default text-red btn-delete"
        >
            <i class="fa fa-trash"></i>
        </button>
    @endif
</div>

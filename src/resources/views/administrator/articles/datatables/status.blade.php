<div class="btn-group">
    <button data-ajax="{!! route('administrator.articles.published', $id) !!}"
            class="btn btn-default btn-xs {{ $published ? 'text-green' : 'text-red' }}"
            data-toggle="tooltip"
            data-title="{{ $published ? trans('cms::button.unpublish') : trans('cms::button.publish')}}"
            data-container="body"
    >
        <i class="fa {{ $published ? 'fa-check-circle' : 'fa-close' }}"></i>
    </button>
    <button data-ajax="{!! route('administrator.articles.featured', $id) !!}"
            class="btn btn-default btn-xs {{ $featured ? 'text-orange' : '' }}"
            data-toggle="tooltip"
            data-title="{{ trans('cms::button.featured')}}"
            data-container="body"
    >
        <i class="fa {{ $featured ? 'fa-star' : 'fa-star-o' }}"></i>
    </button>
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

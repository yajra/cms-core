<div class="page-title-container">
    <i class="{{trans($icon)}}"></i>
    {{trans($title)}}
    <small>{{trans($description)}}</small>
        <span class="pull-right">
            <a href="{{ URL::previous() }}" class="page-title-back-href text-uppercase">
                <i class="fa fa-arrow-circle-left"></i> {{trans('cms::button.back')}}
            </a>
        </span>
</div>
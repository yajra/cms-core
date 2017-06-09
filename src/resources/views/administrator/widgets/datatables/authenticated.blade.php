<span class="badge bg-aqua">
    @if($authenticated)
        <i class="fa fa-lock"></i> {{trans('cms::button.yes')}}
    @else
        <i class="fa fa-unlock"></i> {{trans('cms::button.no')}}
    @endif
</span>

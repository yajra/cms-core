<a href="{{route('administrator.users.edit', $article->created_by)}}"
   data-toggle="tooltip"
   title="{{trans('cms::button.edit')}}"
>
    <i class="fa fa-user"></i> {{$article->createdByName}}
</a>
<br>
<small>(Alias: {{$article->present()->author}})</small>

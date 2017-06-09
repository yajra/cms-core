<a href="{{route('administrator.users.edit', $article->created_by)}}"
   data-toggle="tooltip"
   title="{{trans('cms::button.edit')}}"
>{{$article->createdByName}}</a>
<br>
<small>(Alias: {{$article->present()->author}})</small>

<div class="row">
    <div class="col-xs-12">
        <ul class="list-group">
            <li class="list-group-item list-group-item-heading"><i class="fa fa-newspaper-o"></i> {{$widget->title}}
            </li>
            @forelse($articles as $article)
                <li class="list-group-item"><a href="{{$article->getUrl()}}">{{$article->present()->introTitle(30) }}</a></li>
            @empty
                <li class="list-group-item">{{trans('cms::categories.empty')}}</li>
            @endforelse
        </ul>
    </div>
</div>

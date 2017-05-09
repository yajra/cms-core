<div class="row">
    <div class="col-xs-12">
        <ul class="list-group">
            <li class="list-group-item list-group-item-heading"><i class="fa fa-newspaper-o"></i> {{$widget->title}}
            </li>
            @foreach($articles as $article)
                <li class="list-group-item">
                    <span class="label label-success"><i class="fa fa-eye"></i> {{$article->hits}}</span>
                    <a href="{{$article->getUrl()}}">
                        {{str_limit($article->title, 25)}}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

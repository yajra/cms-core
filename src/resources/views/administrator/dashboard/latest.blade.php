<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title text-uppercase"><i class="fa fa-files-o"></i> Recently Added Articles</h3>
    </div>
    <div class="box-body">
        <ul class="list-group">
            @forelse(\Yajra\CMS\Entities\Article::getRecentlyAdded() as $article)
                <li class="list-group-item">
                    <div class="pull-left">
                        {{ $article->present()->published() }}
                    </div>
                    &nbsp;{{ $article->present()->editLink() }}
                    <div class="pull-right">
                        <i class="fa fa-calendar"></i>
                        {{ $article->present()->dateCreated() }}
                    </div>
                </li>
            @empty
                <li class="list-group-item">No articles found!</li>
            @endforelse
        </ul>
    </div>
</div>
<div class="box box-danger">
    <div class="box-header with-border">
        <h3 class="box-title text-uppercase"><i class="fa fa-star"></i> Popular Articles</h3>
    </div>
    <div class="box-body">
        @forelse(\Yajra\CMS\Entities\Article::getPopular(12) as $article)
            <li class="list-group-item">
                <div class="pull-left">
                    <span class="label bg-green" data-toggle="tooltip" data-title="Hits">{{ $article->hits }}</span>
                </div>
                &nbsp;{{ $article->present()->editLink() }}
                <div class="pull-right">
                    <i class="fa fa-calendar"></i>
                    {{ $article->present()->dateCreated() }}
                </div>
            </li>
        @empty
            <li class="list-group-item">No popular articles found!</li>
        @endforelse
    </div>
</div>
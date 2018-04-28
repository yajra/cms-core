@extends('layouts.master')

@section('title', $category->title)
@section('keywords', $category->param('meta_keywords') ?? config('site.keywords'))
@section('description', $category->param('meta_description') ?? config('site.description'))
@section('author', $category->param('author_alias') ?? config('site.author'))
@section('page-title', $category->title)

@section('content')
    @if($category->description)
        <div class="row category-description">
            <div class="col-md-12">
                {!! $category->description !!}
            </div>
        </div>
    @endif

    <table class="table table-bordered">
        <caption>
            {!! form()->open(['class' => 'form-horizontal', 'id' => 'limit-form', 'method' => 'get']) !!}
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label col-md-2" for="limit">Limit</label>

                        <div class="input-control col-md-4">
                            {!! form()->select('limit', array_combine([5, 10, 15, 25, 50, 100], [5, 10, 15, 25, 50, 100]) , $limit, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
            {{ form()->hidden('layout', 'list') }}
            {!! form()->close() !!}
        </caption>
        <thead>
        <tr>
            <th width="20px">Id</th>
            <th>Title</th>
        </tr>
        </thead>
        @forelse($articles as $article)
            <tr>
                <td>{{ $article->id }}</td>
                <td><a href="{{ $article->getUrl() }}">{{ $article->title }}</a></td>
            </tr>
        @empty
            <tr>
                <td colspan="2">No articles found!</td>
            </tr>
        @endforelse
    </table>

    {!! $articles->render() !!}
@stop

@push('scripts')
<script>
    $(function () {
        $('select[name=limit]').on('change', function () {
            $('#limit-form').submit();
        });
    });
</script>
@endpush

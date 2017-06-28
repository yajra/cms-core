@extends('admin::layouts.master')

@section('title')
    {{trans('cms::article.index.title')}} | @parent
@endsection

@section('body', 'sidebar-collapse')

@section('page-title')
    @pageHeader('cms::article.index.title', 'cms::article.index.description', 'cms::article.index.icon')
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">
                <i class="fa fa-table"></i>&nbsp;{{trans('cms::article.index.title')}}
            </h3>
            <div class="pull-right form-inline">
                <span><i class="fa fa-search"></i> Search Tools: </span>
                {{form()->select('status', $statuses, null, ['class' => 'form-control searchable input-sm'])}}
                {{form()->select('category', $categories, null, ['class' => 'form-control searchable input-sm'])}}
                {{form()->select('is_page', $allYesNo, null, ['class' => 'form-control searchable input-sm'])}}
            </div>
        </div>
        <div class="box-body">
            {{ $dataTable->table(['id' => 'articles-table', 'class' => 'table table-hover margin-top-30']) }}
        </div>
    </div>
@stop

@push('scripts')
{{ $dataTable->scripts() }}
<script>
    $(function () {
        $("select.searchable").on('change', function () {
            LaravelDataTables['articles-table'].draw();
        })
    });
</script>
@endpush

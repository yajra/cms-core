<?php

namespace Yajra\CMS\DataTables;

use Yajra\CMS\Entities\Article;
use Yajra\DataTables\Services\DataTable;

class ArticlesDataTable extends DataTable
{
    /**
     * Build DataTable api response.
     *
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('status', function (Article $article) {
                return view('administrator.articles.datatables.status', $article->toArray());
            })
            ->editColumn('authenticated', function (Article $article) {
                return view('administrator.articles.datatables.authenticated', $article->toArray());
            })
            ->editColumn('published', function (Article $article) {
                return dt_check($article->published);
            })
            ->editColumn('is_page', function (Article $article) {
                return view('administrator.articles.datatables.page', $article->toArray());
            })
            ->editColumn('hits', function (Article $article) {
                return '<span class="badge bg-blue">' . $article->hits . '</span>';
            })
            ->editColumn('category', function (Article $article) {
                return $article->category->title;
            })
            ->addColumn('author', function (Article $article) {
                return view('administrator.articles.datatables.author', compact('article'));
            })
            ->addColumn('slug', function (Article $article) {
                return $article->present()->slug;
            })
            ->editColumn('title', function (Article $article) {
                return view('administrator.articles.datatables.title', compact('article'));
            })
            ->editColumn('plain_title', function (Article $article) {
                return $article->title;
            })
            ->editColumn('created_at', function (Article $article) {
                return $article->created_at->format('Y-m-d');
            })
            ->filterColumn('category_id', function ($query, $keyword) {
                if (is_numeric($keyword)) {
                    $query->where('category_id', $keyword);
                }
            })
            ->rawColumns(['is_page', 'hits', 'title', 'published', 'authenticated', 'action', 'author', 'status']);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $articles = Article::query()->with('category', 'creator')->select('articles.*');

        if ($this->request()->input('category')) {
            $articles->whereHas('category', function ($query) {
                $query->where('categories.id', request('category'));
            });
        }

        if ($this->request()->input('is_page') <> '') {
            $articles->where('is_page', request('is_page'));
        }

        if ($this->request()->input('status') <> '') {
            $articles->where('published', request('status'));
        }

        return $this->applyScopes($articles);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $script = "var formData = $(\"select.searchable\").serializeArray(); $.each(formData, function(i, o){data[o.name] = o.value;});";

        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax('', $script)
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    private function getColumns()
    {
        return [
            [
                'data'      => 'status',
                'name'      => 'articles.published',
                'width'     => '100px',
                'title'     => trans('cms::article.datatable.columns.status'),
                'orderable' => false,
            ],
            [
                'data'  => 'title',
                'name'  => 'articles.title',
                'title' => trans('cms::article.datatable.columns.title'),
            ],
            [
                'data'    => 'alias',
                'name'    => 'articles.alias',
                'visible' => false,
            ],
            [
                'data'    => 'category',
                'name'    => 'category.title',
                'visible' => false,
            ],
            [
                'data'  => 'category',
                'name'  => 'category.id',
                'title' => trans('cms::article.datatable.columns.category'),
                'width' => '100px',
            ],
            [
                'data'       => 'author',
                'title'      => trans('cms::article.datatable.columns.author'),
                'searchable' => false,
                'orderable'  => false,
            ],
            [
                'data'  => 'created_at',
                'name'  => 'articles.created_at',
                'title' => trans('cms::article.datatable.columns.created_at'),
                'width' => '90px',
            ],
            [
                'data'  => 'authenticated',
                'name'  => 'articles.authenticated',
                'width' => '20px',
                'title' => '<i class="fa fa-key" data-toggle="tooltip" data-title="' . trans('cms::article.datatable.columns.authenticated') . '"></i>',
            ],
            [
                'data'  => 'is_page',
                'name'  => 'articles.is_page',
                'title' => trans('cms::article.datatable.columns.is_page'),
                'width' => '20px',
            ],
            [
                'data'  => 'hits',
                'name'  => 'articles.hits',
                'width' => '20px',
                'title' => 'Hits',
            ],
            [
                'data'  => 'id',
                'name'  => 'articles.id',
                'title' => trans('cms::article.datatable.columns.id'),
                'width' => '10px',
            ],
        ];
    }

    /**
     * @return array
     */
    protected function getBuilderParameters()
    {
        return [
            'order'   => [
                [10, 'desc'],
            ],
            'buttons' => [
                [
                    'extend' => 'create',
                    'text'   => '<i class="fa fa-plus"></i>&nbsp;&nbsp;' . trans('cms::article.datatable.buttons.create'),
                ],
                'export',
                'print',
                'reset',
                'reload',
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'articles';
    }
}

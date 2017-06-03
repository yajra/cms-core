<?php

namespace Yajra\CMS\DataTables;

use Yajra\CMS\Entities\Article;
use Yajra\Datatables\Services\DataTable;

class ArticlesDataTable extends DataTable
{
    /**
     * Build DataTable api response.
     *
     * @return \Yajra\Datatables\Engines\BaseEngine
     */
    public function dataTable()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', 'administrator.articles.datatables.action')
            ->editColumn('published', function (Article $article) {
                return dt_check($article->published);
            })
            ->editColumn('authenticated', function (Article $article) {
                return dt_check($article->authenticated);
            })
            ->editColumn('is_page', function (Article $article) {
                return dt_check($article->is_page);
            })
            ->editColumn('hits', function (Article $article) {
                return '<span class="label bg-purple">' . $article->hits . '</span>';
            })
            ->editColumn('category', function (Article $article) {
                return $article->category->present()->name;
            })
            ->editColumn('title', function (Article $article) {
                return view('administrator.articles.datatables.title', compact('article'))->render();
            })
            ->addColumn('plain_title', function (Article $article) {
                return $article->title;
            })
            ->addColumn('slug', function (Article $article) {
                return $article->present()->slug;
            })
            ->rawColumns(['is_page', 'hits', 'title', 'published', 'authenticated', 'action']);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $articles = Article::query()->with('category')->select('articles.*');

        return $this->applyScopes($articles);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->ajax('')
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
                'data'  => 'id',
                'name'  => 'articles.id',
                'title' => trans('cms::article.datatable.columns.id'),
                'width' => '20px',
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
                'data'    => 'category.title',
                'title'   => trans('cms::article.datatable.columns.category'),
                'visible' => true,
                'data'    => 'category',
            ],
            [
                'data'  => 'published',
                'name'  => 'articles.published',
                'width' => '20px',
                'title' => '<i class="fa fa-check-circle" data-toggle="tooltip" data-title="' . trans('cms::article.datatable.columns.published') . '"></i>',
            ],
            [
                'data'  => 'authenticated',
                'name'  => 'articles.authenticated',
                'width' => '20px',
                'title' => '<i class="fa fa-key" data-toggle="tooltip" data-title="' . trans('cms::article.datatable.columns.authenticated') . '"></i>',
            ],
            [
                'data'  => 'order',
                'name'  => 'articles.order',
                'width' => '20px',
                'title' => '<i class="fa fa-list" data-toggle="tooltip" data-title="' . trans('cms::article.datatable.columns.order') . '"></i>',
            ],
            [
                'data'  => 'hits',
                'name'  => 'articles.hits',
                'width' => '20px',
                'title' => '<i class="fa fa-eye" data-toggle="tooltip" data-title="' . trans('cms::article.datatable.columns.hits') . '"></i>',
            ],
            [
                'data'  => 'is_page',
                'name'  => 'articles.is_page',
                'title' => trans('cms::article.datatable.columns.is_page'),
            ],
            [
                'data'  => 'updated_at',
                'name'  => 'articles.updated_at',
                'title' => trans('cms::article.datatable.columns.updated_at'),
                'width' => '100px',
            ],
            [
                'data'       => 'action',
                'title'      => trans('cms::article.datatable.columns.action'),
                'width'      => '134px',
                'searchable' => false,
                'orderable'  => false,
                'className'  => 'text-center',
            ],
        ];
    }

    /**
     * @return array
     */
    protected function getBuilderParameters()
    {
        return [
            'stateSave' => true,
            'buttons'   => [
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

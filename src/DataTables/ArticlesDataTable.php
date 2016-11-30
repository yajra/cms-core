<?php

namespace Yajra\CMS\DataTables;

use Yajra\CMS\Entities\Article;
use Yajra\Datatables\Services\DataTable;

class ArticlesDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
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
            ->editColumn('hits', function (Article $article) {
                return '<span class="label bg-purple">' . $article->hits . '</span>';
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
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $articles = Article::select('articles.*', 'categories.title as category_title')
                           ->join('categories', 'categories.id', '=', 'articles.category_id');

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
                    ->addAction(['width' => '134px', 'className' => 'text-center'])
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
            'id'               => ['name' => 'articles.id', 'width' => '20px'],
            'title'            => ['name' => 'articles.title'],
            'alias'            => ['name' => 'articles.alias', 'visible' => false],
            'categories.title' => ['title' => 'Category', 'visible' => false, 'data' => 'category_title'],
            'published'        => [
                'name'  => 'articles.published',
                'width' => '20px',
                'title' => '<i class="fa fa-check-circle" data-toggle="tooltip" data-title="' . trans('cms::article.datatable.columns.published') . '"></i>',
            ],
            'authenticated'    => [
                'name'  => 'articles.authenticated',
                'width' => '20px',
                'title' => '<i class="fa fa-key" data-toggle="tooltip" data-title="' . trans('cms::article.datatable.columns.authenticated') . '"></i>',
            ],
            'order'            => [
                'name'  => 'articles.order',
                'width' => '20px',
                'title' => '<i class="fa fa-list" data-toggle="tooltip" data-title="' . trans('cms::article.datatable.columns.order') . '"></i>',
            ],
            'hits'             => [
                'name'  => 'articles.hits',
                'width' => '20px',
                'title' => '<i class="fa fa-eye" data-toggle="tooltip" data-title="' . trans('cms::article.datatable.columns.hits') . '"></i>',
            ],
            'created_at'       => ['name' => 'articles.created_at', 'width' => '100px'],
            'updated_at'       => ['name' => 'articles.updated_at', 'width' => '100px'],
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

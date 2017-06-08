<?php

namespace Yajra\CMS\DataTables;

use Yajra\CMS\Entities\Article;
use Yajra\CMS\Entities\Category;
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

        if ($this->request()->input('category')) {
            $articles->whereHas('category', function ($query) {
                $query->where('categories.id', request('category'));
            });
        }

        if ($this->request()->input('is_page')) {
            $articles->where('is_page', request('is_page'));
        }

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
                    ->ajax([
                        'url'  => '',
                        'data' => 'function(d) {
                            var formData = $("select.searchable").serializeArray();
                            $.each(formData, function(i, data){d[data.name] = data.value;});
                        }',
                    ])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    private function getColumns()
    {
        $categories = Category::root()->getDescendants()->pluck('title', 'id');
        $categories = collect(['' => 'All Category'])->union($categories);

        $allYesNo = [
            '' => 'All',
            0  => 'No',
            1  => 'Yes',
        ];

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
                'data'    => 'category',
                'name'    => 'category.title',
                'visible' => false,
            ],
            [
                'data'   => 'category',
                'name'   => 'category.id',
                'title'  => trans('cms::article.datatable.columns.category'),
                'width'  => '100px',
                'footer' => form()->select('category', $categories, null, ['class' => 'form-control searchable']),
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
                'data'   => 'is_page',
                'name'   => 'articles.is_page',
                'title'  => trans('cms::article.datatable.columns.is_page'),
                'class'  => 'text-center',
                'footer' => form()->select('is_page', $allYesNo, null, ['class' => 'form-control searchable']),
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

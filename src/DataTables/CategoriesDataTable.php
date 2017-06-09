<?php

namespace Yajra\CMS\DataTables;

use Yajra\CMS\Entities\Category;
use Yajra\Datatables\Services\DataTable;

class CategoriesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @return \Yajra\Datatables\Engines\EloquentEngine
     */
    public function dataTable()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('lft', '<i class="fa fa-dot-circle-o"></i>')
            ->addColumn('action', function (Category $category) {
                return view('administrator.categories.datatables.action', $category->toArray());
            })
            ->editColumn('authenticated', function (Category $category) {
                return view('administrator.categories.datatables.authenticated', $category->toArray());
            })
            ->addColumn('pub', function (Category $category) {
                return '<span class="badge bg-green">' . $category->countPublished() . '</span>';
            })
            ->addColumn('unpub', function (Category $category) {
                return '<span class="badge bg-yellow">' . $category->countUnpublished() . '</span>';
            })
            ->editColumn('hits', function (Category $category) {
                return '<span class="badge bg-blue">' . $category->hits . '</span>';
            })
            ->editColumn('title', function (Category $category) {
                return view('administrator.categories.datatables.title', compact('category'));
            })
            ->editColumn('created_at', function (Category $category) {
                return $category->created_at->format('Y-m-d');
            })
            ->rawColumns(['lft', 'published', 'authenticated', 'hits', 'title', 'action', 'pub', 'unpub']);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $category = Category::query()->whereNotNull('parent_id')->select('categories.*');

        return $this->applyScopes($category);
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
    protected function getColumns()
    {
        return [
            [
                'data'  => 'lft',
                'name'  => 'lft',
                'width' => '20px',
                'title' => '<i class="fa fa-tree" data-toggle="tooltip" data-title="' . trans('cms::categories.datatable.columns.lft') . '"></i>',
            ],
            [
                'data'       => 'action',
                'name'       => 'action',
                'width'      => '80px',
                'title'      => trans('cms::categories.datatable.columns.action'),
                'orderable'  => false,
                'searchable' => false,
            ],
            [
                'data'  => 'title',
                'name'  => 'title',
                'title' => trans('cms::categories.datatable.columns.title'),
            ],
            [
                'data'    => 'alias',
                'name'    => 'alias',
                'title'   => trans('cms::categories.datatable.columns.alias'),
                'visible' => false,
            ],
            [
                'data'  => 'authenticated',
                'name'  => 'authenticated',
                'width' => '20px',
                'title' => '<i class="fa fa-key" data-toggle="tooltip" data-title="' . trans('cms::categories.datatable.columns.authenticated') . '"></i>',
            ],
            [
                'data'       => 'pub',
                'name'       => 'pub',
                'width'      => '20px',
                'title'      => '<i class="fa fa-check-circle-o" data-toggle="tooltip" data-title="' . trans('cms::categories.datatable.columns.pub') . '"></i>',
                'orderable'  => false,
                'searchable' => false,
            ],
            [
                'data'       => 'unpub',
                'name'       => 'unpub',
                'width'      => '20px',
                'title'      => '<i class="fa fa-close" data-toggle="tooltip" data-title="' . trans('cms::categories.datatable.columns.unpub') . '"></i>',
                'orderable'  => false,
                'searchable' => false,
            ],
            [
                'data'  => 'hits',
                'name'  => 'hits',
                'width' => '20px',
                'title' => '<i class="fa fa-eye" data-toggle="tooltip" data-title="' . trans('cms::categories.datatable.columns.hits') . '"></i>',
            ],
            [
                'data'  => 'created_at',
                'name'  => 'created_at',
                'width' => '100px',
                'title' => trans('cms::categories.datatable.columns.created_at'),
            ],
            [
                'data'  => 'id',
                'name'  => 'categories.id',
                'title' => trans('cms::categories.datatable.columns.id'),
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
            'stateSave' => true,
            'order'     => [[0, 'asc']],
            'buttons'   => [
                [
                    'extend' => 'create',
                    'text'   => '<i class="fa fa-plus"></i>&nbsp;&nbsp;' . trans('cms::categories.datatable.buttons.create'),
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
        return 'categories_' . time();
    }
}

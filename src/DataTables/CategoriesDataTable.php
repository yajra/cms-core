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
            ->editColumn('title', function (Category $category) {
                return $category->present()->indentedTitle();
            })
            ->editColumn('lft', '<i class="fa fa-dot-circle-o"></i>')
            ->editColumn('status', function (Category $category) {
                if ($category->isPublished()) {
                    $attr = 'label-danger" title="Unpublished" ><i class="fa fa-remove">';
                } else {
                    $attr = 'label-success" title="Published" ><i class="fa fa-check">';
                }

                return '<span data-toggle="tooltip" data-placement="right" class="badge ' . $attr . '</i></span>';
            })
            ->addColumn('action', 'administrator.categories.datatables.action')
            ->editColumn('authenticated', function (Category $category) {
                return dt_check($category->authenticated);
            })
            ->addColumn('pub', function (Category $category) {
                return $category->countPublished();
            })
            ->addColumn('unpub', function (Category $category) {
                return $category->countUnpublished();
            })
            ->editColumn('hits', function (Category $category) {
                return '<span class="label bg-purple">' . $category->hits . '</span>';
            })
            ->editColumn('title', function (Category $category) {
                return view('administrator.categories.datatables.title', compact('category'))->render();
            })
            ->rawColumns(['lft', 'status', 'authenticated', 'hits', 'title', 'action']);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $category = Category::select([
            'categories.id',
            'categories.lft',
            \DB::raw('categories.published as status'),
            'categories.title',
            'categories.depth',
            'categories.alias',
            'categories.hits',
            'categories.authenticated',
            'categories.published',
            'categories.created_at',
            'categories.updated_at',
        ])->whereNotNull('parent_id');

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
                    ->addAction(['width' => '110px'])
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
            'lft'           => [
                'width' => '20px',
                'title' => '<i class="fa fa-tree" data-toggle="tooltip" data-title="' . trans('cms::categories.datatable.columns.lft') . '"></i>',
            ],
            'id'            => ['width' => '20px'],
            'title',
            'alias'         => ['visible' => false],
            'status'        => [
                'width'      => '20px',
                'searchable' => false,
                'title'      => '<i class="fa fa-check-circle" data-toggle="tooltip" data-title="' . trans('cms::categories.datatable.columns.status') . '"></i>',
            ],
            'authenticated' => [
                'width' => '20px',
                'title' => '<i class="fa fa-key" data-toggle="tooltip" data-title="' . trans('cms::categories.datatable.columns.authenticated') . '"></i>',
            ],
            'pub'           => [
                'width'      => '20px',
                'title'      => '<i class="fa fa-check-circle-o" data-toggle="tooltip" data-title="' . trans('cms::categories.datatable.columns.pub') . '"></i>',
                'orderable'  => false,
                'searchable' => false,
            ],
            'unpub'         => [
                'width'      => '20px',
                'title'      => '<i class="fa fa-close" data-toggle="tooltip" data-title="' . trans('cms::categories.datatable.columns.unpub') . '"></i>',
                'orderable'  => false,
                'searchable' => false,
            ],
            'hits'          => [
                'width' => '20px',
                'title' => '<i class="fa fa-eye" data-toggle="tooltip" data-title="' . trans('cms::categories.datatable.columns.hits') . '"></i>',
            ],
            'created_at'    => ['width' => '100px'],
            'updated_at'    => ['width' => '100px'],
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

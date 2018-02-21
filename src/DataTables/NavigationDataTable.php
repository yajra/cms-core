<?php

namespace Yajra\CMS\DataTables;

use Yajra\CMS\Entities\Navigation;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class NavigationDataTable extends DataTable
{
    /**
     * Build DataTable api response.
     *
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable()
    {
        return (new EloquentDataTable($this->query()))
            ->addColumn('menus', function (Navigation $nav) {
                return '<span class="badge label-primary">' . $nav->menus()->count() . '</span>';
            })
            ->editColumn('title', function (Navigation $navigation) {
                return html()->linkRoute('administrator.navigation.edit', $navigation->title, $navigation);
            })
            ->addColumn('action', function (Navigation $nav) {
                return view('administrator.navigation.datatables.action', $nav->toArray());
            })
            ->rawColumns(['menus', 'published', 'action'])
            ->editColumn('published', function (Navigation $row) {
                return dt_check($row->published);
            });
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $users = Navigation::query();

        return $this->applyScopes($users);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->postAjax()
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
                'data'       => 'action',
                'name'       => 'action',
                'width'      => '100px',
                'title'      => trans('cms::navigation.datatable.columns.action'),
                'orderable'  => false,
                'searchable' => false,
            ],
            [
                'data'  => 'title',
                'name'  => 'title',
                'title' => trans('cms::navigation.datatable.columns.title'),
            ],
            [
                'data'  => 'type',
                'name'  => 'type',
                'title' => trans('cms::navigation.datatable.columns.type'),
                'width' => '80px',
            ],
            [
                'data'       => 'menus',
                'name'       => 'menus',
                'orderable'  => false,
                'searchable' => false,
                'width'      => '25px',
                'title'      => '<i class="fa fa-clone" data-toggle="tooltip" data-title="' . trans('cms::navigation.datatable.columns.menus') . '"></i>',
            ],
            [
                'data'  => 'published',
                'name'  => 'published',
                'width' => '20px',
                'title' => '<i class="fa fa-check-circle" data-toggle="tooltip" data-title="' . trans('cms::navigation.datatable.columns.published') . '"></i>',
            ],
            [
                'data'  => 'created_at',
                'name'  => 'created_at',
                'title' => trans('cms::navigation.datatable.columns.created_at'),
                'width' => '100px',
            ],
            [
                'data'  => 'updated_at',
                'name'  => 'updated_at',
                'title' => trans('cms::navigation.datatable.columns.updated_at'),
                'width' => '100px',
            ],
            [
                'data'  => 'id',
                'name'  => 'id',
                'title' => trans('cms::navigation.datatable.columns.id'),
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
            'order'     => [
                [7, 'desc'],
            ],
            'buttons'   => [
                [
                    'extend' => 'create',
                    'text'   => '<i class="fa fa-plus"></i>&nbsp;&nbsp;' . trans('cms::navigation.datatable.buttons.create'),
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
        return 'navigation_' . date('Ymdhis');
    }
}

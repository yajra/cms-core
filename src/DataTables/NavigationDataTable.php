<?php

namespace Yajra\CMS\DataTables;

use Yajra\CMS\Entities\Navigation;
use Yajra\Datatables\Services\DataTable;

class NavigationDataTable extends DataTable
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
            ->addColumn('action', 'administrator.navigation.datatables.action')
            ->addColumn('menus', function (Navigation $nav) {
                return '<span class="badge label-primary">' . $nav->menus()->count() . '</span>';
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
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->ajax('')
                    ->addAction(['width' => '150px', 'className' => 'text-center'])
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
            'id'         => ['width' => '20px'],
            'title',
            'type'       => ['width' => '80px'],
            'menus'      => [
                'orderable'  => false,
                'name'       => 'menus',
                'searchable' => false,
                'width'      => '25px',
                'title'      => '<i class="fa fa-clone" data-toggle="tooltip" data-title="' . trans('cms::navigation.datatable.columns.menus') . '"></i>',
            ],
            'published'  => [
                'name'  => 'published',
                'width' => '20px',
                'title' => '<i class="fa fa-check-circle" data-toggle="tooltip" data-title="' . trans('cms::navigation.datatable.columns.published') . '"></i>',
            ],
            'created_at' => ['width' => '120px'],
            'updated_at' => ['width' => '120px'],
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
        return 'navigation';
    }
}

<?php

namespace Yajra\CMS\DataTables;

use Yajra\CMS\Entities\Navigation;
use Yajra\Datatables\Services\DataTable;

class NavigationDataTable extends DataTable
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
            ->addColumn('action', 'administrator.navigation.datatables.action')
            ->addColumn('menus', function (Navigation $nav) {
                return '<span class="badge label-primary">' . $nav->menus()->count() . '</span>';
            })
            ->editColumn('published', function (Navigation $row) {
                return dt_check($row->published);
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
                'title'      => '<i class="fa fa-clone" data-toggle="tooltip" data-title="Number of Menu Items"></i>',
            ],
            'published'  => [
                'name'  => 'published',
                'width' => '20px',
                'title' => '<i class="fa fa-check-circle" data-toggle="tooltip" data-title="Published"></i>',
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
                    'text'   => '<i class="fa fa-plus"></i>&nbsp;&nbsp;New Navigation',
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

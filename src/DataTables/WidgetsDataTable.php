<?php

namespace Yajra\CMS\DataTables;

use Yajra\CMS\Entities\Widget;
use Yajra\Datatables\Services\DataTable;

class WidgetsDataTable extends DataTable
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
            ->editColumn('published', function (Widget $widget) {
                return dt_check($widget->published);
            })
            ->editColumn('authenticated', function (Widget $widget) {
                return dt_check($widget->authenticated);
            })
            ->addColumn('action', 'administrator.widgets.datatables.action')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $users = Widget::query()
                       ->select('widgets.*')
                       ->with([
                           'extension' => function ($query) {
                               $query->select('id', 'name');
                           },
                       ])
                       ->withoutGlobalScope('menu_assignment');

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
                    ->addAction(['width' => '104px'])
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
            'id'             => ['width' => '20px', 'name' => 'widgets.id'],
            'title',
            'position'       => ['width' => '80px'],
            'extension.name' => [
                'width' => '60px',
                'title' => '<i class="fa fa-plug" data-toggle="tooltip" data-title="Widget Extension"></i> Ext.',
            ],
            'published'      => [
                'width' => '20px',
                'title' => '<i class="fa fa-check-circle" data-toggle="tooltip" data-title="Published"></i>',
            ],
            'authenticated'  => [
                'width' => '20px',
                'title' => '<i class="fa fa-key" data-toggle="tooltip" data-title="Authentication Required"></i>',
            ],
            'order'          => [
                'width' => '20px',
                'title' => '<i class="fa fa-list" data-toggle="tooltip" data-title="Sort/Order"></i>',
                'name'  => 'widgets.order',
            ],
            'updated_at'     => [
                'searchable' => false,
                'width'      => '100px',
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
            'order'     => [0, 'desc'],
            'buttons'   => [
                [
                    'extend' => 'create',
                    'text'   => '<i class="fa fa-plus"></i>&nbsp;&nbsp;New Widget',
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
        return 'widgets';
    }
}

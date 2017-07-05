<?php

namespace Yajra\CMS\DataTables;

use Yajra\CMS\Entities\Widget;
use Yajra\DataTables\Services\DataTable;

class WidgetsDataTable extends DataTable
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
            ->editColumn('authenticated', function (Widget $widget) {
                return view('administrator.widgets.datatables.authenticated', $widget->toArray());
            })
            ->editColumn('title', function (Widget $widget) {
                return html()->linkRoute('administrator.widgets.edit', $widget->title, $widget);
            })
            ->editColumn('template', function (Widget $widget) {
                return '<code>' . implode('/', explode('.', $widget->present()->template)) . '.blade.php' . '</code>';
            })
            ->editColumn('position', function (Widget $widget) {
                return '<span class="badge bg-orange">' . $widget->position . '</span>';
            })
            ->editColumn('action', function (Widget $widget) {
                return view('administrator.widgets.datatables.action', $widget->toArray());
            })
            ->editColumn('created_at', function (Widget $category) {
                return $category->created_at->format('Y-m-d');
            })
            ->rawColumns(['published', 'authenticated', 'action', 'template', 'position']);
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
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
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
            'action'        => [
                'width'      => '80px',
                'title'      => trans('cms::widget.datatable.columns.action'),
                'orderable'  => false,
                'searchable' => false,
            ],

            'title',
            'template',
            'position'       => ['width' => '80px'],
            'extension.name' => [
                'width' => '120px',
                'title' => '<i class="fa fa-plug" data-toggle="tooltip" data-title="' . trans('cms::widget.datatable.columns.extensionName') . '"></i> Ext.',
            ],
            'authenticated'  => [
                'width' => '20px',
                'title' => '<i class="fa fa-key" data-toggle="tooltip" data-title="' . trans('cms::widget.datatable.columns.authenticated') . '"></i>',
            ],
            'created_at'     => [
                'searchable' => false,
                'width'      => '100px',
                'title' => trans('cms::widget.datatable.columns.created_at'),
            ],
            [
                'data'  => 'id',
                'name'  => 'widgets.id',
                'title' => trans('cms::widget.datatable.columns.id'),
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
            'order'     => [7, 'desc'],
            'buttons'   => [
                [
                    'extend' => 'create',
                    'text'   => '<i class="fa fa-plus"></i>&nbsp;&nbsp;' . trans('cms::widget.datatable.buttons.create'),
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

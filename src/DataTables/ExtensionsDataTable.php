<?php

namespace Yajra\CMS\DataTables;

use Yajra\CMS\Entities\Extension;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class ExtensionsDataTable extends DataTable
{
    /**
     * Build DataTable api response.
     *
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable()
    {
        return (new EloquentDataTable($this->query()))
            ->addColumn('action', 'administrator.extensions.datatables.action')
            ->editColumn('name', function ($extension) {
                return "<h3 class=\"lead no-margin text-blue\">{$extension->name} <small>{$extension->version}</small></h3>
                            <p>{$extension->description}</p>";
            })
            ->editColumn('type', function ($extension) {
                return dt_label($extension->type, 'danger');
            })
            ->editColumn('enabled', function ($extension) {
                return dt_check($extension->enabled);
            })
            ->rawColumns(['action', 'name', 'type', 'enabled']);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $users = Extension::query();

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
                    ->parameters([
                        'order'   => [[0, 'desc']],
                        'buttons' => [
                            'export',
                            'print',
                            'reset',
                            'reload',
                        ],
                    ]);
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
                'data'  => 'id',
                'name'  => 'id',
                'width' => '20px',
                'title' => trans('cms::extension.table.id'),
            ],
            [
                'data'  => 'name',
                'name'  => 'name',
                'title' => trans('cms::extension.table.name'),
            ],
            [
                'data'  => 'type',
                'name'  => 'type',
                'width' => '60px',
                'title' => trans('cms::extension.table.type'),
            ],
            [
                'data'  => 'enabled',
                'name'  => 'enabled',
                'width' => '20px',
                'title' => trans('cms::extension.table.enabled'),
            ],
            [
                'data'       => 'action',
                'name'       => 'action',
                'title'      => trans('cms::extension.datatable.columns.action'),
                'width'      => '60px',
                'orderable'  => false,
                'searchable' => false,
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
        return 'extensions';
    }
}

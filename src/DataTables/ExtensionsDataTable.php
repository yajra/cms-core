<?php

namespace Yajra\CMS\DataTables;

use Yajra\CMS\Entities\Extension;
use Yajra\Datatables\Services\DataTable;

class ExtensionsDataTable extends DataTable
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
            ->make(true);
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
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->ajax('')
                    ->addAction(['width' => '80px'])
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
            'id'      => ['width' => '20px', 'title' => trans('cms::extension.table.id')],
            'name'    => ['title' => trans('cms::extension.table.name')],
            'type'    => ['width' => '60px', 'title' => trans('cms::extension.table.type')],
            'enabled' => ['width' => '20px', 'title' => trans('cms::extension.table.enabled')],
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

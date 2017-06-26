<?php

namespace Yajra\CMS\DataTables;

use Yajra\CMS\Entities\Menu;
use Yajra\CMS\Entities\Navigation;
use Yajra\Datatables\Services\DataTable;

class MenuItemsDataTable extends DataTable
{
    /**
     * @var \Yajra\CMS\Entities\Navigation
     */
    protected $navigation;

    /**
     * Build DataTable api response.
     *
     * @return \Yajra\Datatables\Engines\BaseEngine
     */
    public function dataTable()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('alias', function (Menu $menu) {
                return '<span class="label bg-primary">' . $menu->alias . '</span>';
            })
            ->editColumn('published', function (Menu $menu) {
                return dt_check($menu->published);
            })
            ->editColumn('authenticated', function (Menu $menu) {
                return view('administrator.navigation.menu.datatables.authenticated', $menu->toArray());
            })
            ->editColumn('title', function (Menu $menu) {
                return view('administrator.navigation.menu.datatables.title', compact('menu'))->render();
            })
            ->addColumn('type', function (Menu $menu) {
                return $menu->extension->name;
            })
            ->editColumn('lft', '<i class="fa fa-dot-circle-o"></i>')
            ->addColumn('action', 'administrator.navigation.menu.datatables.action')
            ->rawColumns(['alias', 'published', 'authenticated', 'title', 'lft', 'action']);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $users = Menu::query()
                     ->with('extension')
                     ->where('navigation_id', $this->navigation->id)
                     ->select('menus.*');

        return $this->applyScopes($users);
    }

    /**
     * @param \Yajra\CMS\Entities\Navigation $navigation
     * @return $this
     */
    public function forNavigation(Navigation $navigation)
    {
        $this->navigation = $navigation;

        return $this;
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
            [
                'data'  => 'lft',
                'name'  => 'lft',
                'width' => '10px',
                'title' => '<i class="fa fa-tree" data-toggle="tooltip" data-title="' . trans('cms::menu.datatable.columns.lft') . '"></i>',
            ],
            [
                'data'       => 'action',
                'name'       => 'action',
                'width'      => '70px',
                'title'      => trans('cms::menu.datatable.columns.action'),
                'orderable'  => false,
                'searchable' => false,
            ],
            [
                'data'  => 'title',
                'name'  => 'title',
                'title' => trans('cms::menu.datatable.columns.title'),
            ],
            [
                'data'  => 'type',
                'name'  => 'menus.extension_id',
                'title' => trans('cms::menu.datatable.columns.type'),
            ],
            [
                'data'    => 'url',
                'name'    => 'url',
                'title'   => trans('cms::menu.datatable.columns.url'),
                'visible' => false,
            ],
            [
                'data'  => 'authenticated',
                'name'  => 'authenticated',
                'width' => '20px',
                'title' => '<i class="fa fa-key" data-toggle="tooltip" data-title="' . trans('cms::menu.datatable.columns.authenticated') . '"></i>',
            ],
            [
                'data'  => 'order',
                'name'  => 'order',
                'width' => '20px',
                'title' => '<i class="fa fa-list" data-toggle="tooltip" data-title="' . trans('cms::menu.datatable.columns.order') . '"></i>',
            ],
            [
                'data'  => 'depth',
                'name'  => 'depth',
                'width' => '20px',
                'title' => '<i class="fa fa-sitemap" data-toggle="tooltip" data-title="' . trans('cms::menu.datatable.columns.depth') . '"></i>',
            ],
            [
                'data'  => 'id',
                'name'  => 'id',
                'title' => trans('cms::menu.datatable.columns.id'),
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
                    'text'   => '<i class="fa fa-plus"></i>&nbsp;&nbsp;' . trans('cms::menu.datatable.buttons.create'),
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
        return 'menu_' . time();
    }
}

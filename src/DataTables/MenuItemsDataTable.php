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
                return dt_check($menu->authenticated);
            })
            ->editColumn('title', function (Menu $menu) {
                return view('administrator.navigation.menu.datatables.title', compact('menu'))->render();
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
        $users = Menu::query()->where('navigation_id', $this->navigation->id);

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
                    ->ajax('')
                    ->addAction(['width' => '104px', 'className' => 'text-center'])
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
                'title' => '<i class="fa fa-tree" data-toggle="tooltip" data-title="' . trans('cms::menu.datatable.columns.lft') . '"></i>',
            ],
            'id'            => ['width' => '20px'],
            'title',
            'url'           => ['visible' => false],
            'published'     => [
                'width' => '20px',
                'title' => '<i class="fa fa-check-circle" data-toggle="tooltip" data-title="' . trans('cms::menu.datatable.columns.published') . '"></i>',
            ],
            'authenticated' => [
                'width' => '20px',
                'title' => '<i class="fa fa-key" data-toggle="tooltip" data-title="' . trans('cms::menu.datatable.columns.authenticated') . '"></i>',
            ],
            'order'         => [
                'width' => '20px',
                'title' => '<i class="fa fa-list" data-toggle="tooltip" data-title="' . trans('cms::menu.datatable.columns.order') . '"></i>',
            ],
            'depth'         => [
                'width' => '20px',
                'title' => '<i class="fa fa-sitemap" data-toggle="tooltip" data-title="' . trans('cms::menu.datatable.columns.depth') . '"></i>',
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

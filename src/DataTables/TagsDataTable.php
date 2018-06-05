<?php

namespace Yajra\CMS\DataTables;

use Conner\Tagging\Model\Tag;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class TagsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable()
    {
        return (new EloquentDataTable($this->query()))
            ->addColumn('action', function (Tag $tag) {
                return view('administrator.tags.datatables.action', $tag->toArray());
            })
            ->editColumn('name', function (Tag $tag) {
                return view('administrator.tags.datatables.title', compact('tag'));
            })
            ->rawColumns(['action','name']);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $tag = Tag::query();

        return $this->applyScopes($tag);
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
    protected function getColumns()
    {
        return [
            [
                'data'       => 'action',
                'name'       => 'action',
                'width'      => '80px',
                'title'      => trans('cms::tag.datatable.columns.action'),
                'orderable'  => false,
                'searchable' => false,
                'printable'  => false,
                'exportable' => false,
            ],
            [
                'data'  => 'name',
                'name'  => 'name',
                'title' => trans('cms::tag.datatable.columns.name'),
            ],
            [
                'data'  => 'slug',
                'name'  => 'slug',
                'title' => trans('cms::tag.datatable.columns.slug'),
            ],
            [
                'data'  => 'suggest',
                'name'  => 'suggest',
                'title' => trans('cms::tag.datatable.columns.suggest'),
            ],
            [
                'data'  => 'count',
                'name'  => 'count',
                'title' => trans('cms::tag.datatable.columns.count'),
            ],
            [
                'data'  => 'id',
                'name'  => 'tagging_tags.id',
                'title' => trans('cms::tag.datatable.columns.id'),
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
            'order'     => [[5, 'asc']],
            'buttons'   => [
                [
                    'extend' => 'create',
                    'text'   => '<i class="fa fa-plus"></i>&nbsp;&nbsp;' . trans('cms::tag.datatable.buttons.create'),
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
        return 'tags';
    }
}

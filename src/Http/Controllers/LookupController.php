<?php

namespace Yajra\CMS\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\CMS\DataTables\LookupDataTable;
use Yajra\CMS\Entities\Lookup;
use Yajra\CMS\Http\Requests\LookupFormRequest;

class LookupController extends Controller
{
    /**
     * Get lookup lists for given type.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $type
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request, $type)
    {
        return new JsonResponse(array_merge($request->all(), [
            'type' => $type,
            'data' => Lookup::type($type)->get(['value', 'key']),
        ]));
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Yajra\CMS\DataTables\LookupDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(LookupDataTable $dataTable)
    {
        $widgets = Lookup::type('widgets.types')->get();

        return $dataTable->render('administrator.lookup.index', compact('widgets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \Yajra\CMS\Entities\Lookup $lookup
     * @return \Illuminate\Http\Response
     */
    public function create(Lookup $lookup)
    {
        return view('administrator.lookup.create', compact('lookup'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Yajra\CMS\Http\Requests\LookupFormRequest $request
     * @param \Yajra\CMS\Entities\Lookup $lookup
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LookupFormRequest $request, Lookup $lookup)
    {
        $lookup->fill($request->all());
        $lookup->save();
        flash()->success('Lookup Registry successfully created!');

        return redirect()->route('administrator.lookup.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Yajra\CMS\Entities\Lookup $lookup
     * @return \Illuminate\Http\Response
     */
    public function edit(Lookup $lookup)
    {
        return view('administrator.lookup.edit', compact('lookup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Yajra\CMS\Http\Requests\LookupFormRequest $request
     * @param \Yajra\CMS\Entities\Lookup $lookup
     * @return \Illuminate\Http\Response
     */
    public function update(LookupFormRequest $request, Lookup $lookup)
    {
        $lookup->fill($request->all());
        $lookup->save();
        flash()->success('Lookup Registry successfully updated!');

        return redirect()->route('administrator.lookup.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Yajra\CMS\Entities\Lookup $lookup
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Lookup $lookup)
    {
        $lookup->delete();

        return $this->notifySuccess('Lookup successfully deleted!');
    }
}

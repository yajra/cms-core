<?php

namespace Yajra\CMS\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\CMS\Entities\Configuration;
use Yajra\CMS\Theme\Repository;

class ThemesController extends Controller
{
    /**
     * @var \Yajra\CMS\Theme\Repository
     */
    private $themes;

    /**
     * ThemesController constructor.
     *
     * @param \Yajra\CMS\Theme\Repository $themes
     */
    public function __construct(Repository $themes)
    {
        $this->themes = $themes;
    }

    /**
     * Display themes resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $themes = $this->themes->all();

        return view('administrator.themes.index', compact('themes'));
    }

    /**
     * Store new default theme.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        /** @var Configuration $config */
        $config = Configuration::query()->firstOrCreate(['key' => 'theme.frontend']);
        $config->value = $request->get('theme');
        $config->save();

        flash()->success(trans('cms::theme.success', ['theme' => $request->get('theme')]));
        
        return back();
    }
}

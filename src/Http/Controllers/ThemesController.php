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
    protected $themes;

    /**
     * ThemesController constructor.
     *
     * @param \Yajra\CMS\Theme\Repository $themes
     */
    public function __construct(Repository $themes)
    {
        $this->authorizePermissionResource('theme');
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
        $config        = Configuration::query()->firstOrCreate(['key' => 'theme.frontend']);
        $config->value = $request->get('theme');
        $config->save();

        flash()->success(trans('cms::theme.success', ['theme' => $request->get('theme')]));

        return back();
    }

    /**
     * Uninstall a theme.
     *
     * @param string $theme
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($theme)
    {
        if ($this->themes->uninstall($theme)) {
            flash()->success(trans('cms::theme.deleted', compact('theme')));
        } else {
            flash()->error(trans('cms::theme.error', compact('theme')));
        }

        return back();
    }
}

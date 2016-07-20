<?php

namespace Yajra\CMS\Http\Controllers;

use Yajra\CMS\DataTables\ArticlesDataTable;
use Yajra\CMS\Entities\Article;
use Yajra\CMS\Http\Requests\ArticlesFormRequest;
use App\Http\Requests;

class ArticlesController extends Controller
{
    /**
     * Controller specific permission ability map.
     *
     * @var array
     */
    protected $customPermissionMap = [
        'publish' => 'update',
    ];

    /**
     * ArticlesController constructor.
     */
    public function __construct()
    {
        $this->authorizePermissionResource('article');
    }

    /**
     * Display list of articles.
     *
     * @param \Yajra\CMS\DataTables\ArticlesDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(ArticlesDataTable $dataTable)
    {
        return $dataTable->render('administrator.articles.index');
    }

    /**
     * Show articles form.
     *
     * @param \Yajra\CMS\Entities\Article $article
     * @return mixed
     */
    public function create(Article $article)
    {
        $article->published = true;

        return view('administrator.articles.create', compact('article'));
    }

    /**
     * Store a newly created article.
     *
     * @param ArticlesFormRequest $request
     * @return mixed
     */
    public function store(ArticlesFormRequest $request)
    {
        $article = new Article;
        $article->fill($request->all());
        $article->published     = $request->get('published', false);
        $article->featured      = $request->get('featured', false);
        $article->authenticated = $request->get('authenticated', false);
        $article->save();
        $article->permissions()->sync($request->get('permissions', []));
        flash()->success(trans('cms::article.store.success'));

        return redirect()->route('administrator.articles.index');
    }

    /**
     * Show and edit selected article.
     *
     * @param \Yajra\CMS\Entities\Article $article
     * @return mixed
     */
    public function edit(Article $article)
    {
        return view('administrator.articles.edit', compact('article'));
    }

    /**
     * Update selected article.
     *
     * @param \Yajra\CMS\Entities\Article $article
     * @param ArticlesFormRequest $request
     * @return mixed
     */
    public function update(Article $article, ArticlesFormRequest $request)
    {
        $article->fill($request->all());
        $article->published     = $request->get('published', false);
        $article->featured      = $request->get('featured', false);
        $article->authenticated = $request->get('authenticated', false);
        $article->save();
        $article->permissions()->sync($request->get('permissions', []));
        flash()->success(trans('cms::article.update.success'));

        return redirect()->route('administrator.articles.index');
    }

    /**
     * Remove selected article.
     *
     * @param \Yajra\CMS\Entities\Article $article
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return $this->notifySuccess(trans('cms::article.destroy.success'));
    }

    /**
     * Publish/Unpublish a article.
     *
     * @param \Yajra\CMS\Entities\Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function publish(Article $article)
    {
        $article->togglePublishedState();

        return $this->notifySuccess(trans(
                'cms::article.update.publish', [
                'task' => $article->published ? 'published' : 'unpublished',
            ])
        );
    }
}

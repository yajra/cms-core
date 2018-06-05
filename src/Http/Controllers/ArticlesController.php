<?php

namespace Yajra\CMS\Http\Controllers;

use Conner\Tagging\Model\Tag;
use Yajra\CMS\DataTables\ArticlesDataTable;
use Yajra\CMS\Entities\Article;
use Yajra\CMS\Entities\Category;
use Yajra\CMS\Events\Articles\ArticleWasCreated;
use Yajra\CMS\Events\Articles\ArticleWasUpdated;
use Yajra\CMS\Http\Requests\ArticlesFormRequest;

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
        $categories = [];
        $allYesNo   = [];
        $statuses   = [];

        if (! request()->wantsJson()) {
            $categories = Category::root()->getDescendants()->map(function(Category $category) {
                $category->title = $category->present()->name;
                return $category;
            })->pluck('title', 'id');
            $categories = collect(['' => '- Select Category -'])->union($categories);

            $allYesNo = [
                '' => '- Select Article Type -',
                0  => 'Article',
                1  => 'Page',
            ];

            $statuses = [
                '' => '- Select Status -',
                0  => 'Unpublished',
                1  => 'Published',
            ];
        }

        return $dataTable->render('administrator.articles.index', compact('categories', 'allYesNo', 'statuses'));
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
        $article->setHighestOrderNumber();
        $tags = Tag::all()->pluck('name');

        return view('administrator.articles.create', compact('article', 'tags'));
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
        $article->is_page       = $request->get('is_page', false);
        $article->save();

        $article->permissions()->sync($request->get('permissions', []));
        if ($request->tags) {
            $article->tag(explode(',', $request->tags));
        }

        event(new ArticleWasCreated($article));

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
        $tags         = Tag::all()->pluck('name');
        $selectedTags = implode(',', $article->tagNames());

        return view('administrator.articles.edit', compact('article', 'tags', 'selectedTags'));
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
        $article->is_page       = $request->get('is_page', false);
        $article->save();

        $article->permissions()->sync($request->get('permissions', []));
        if ($request->tags) {
            $article->retag(explode(',', $request->tags));
        }

        event(new ArticleWasUpdated($article));

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
    public function published(Article $article)
    {
        $article->togglePublishedState();

        return $this->notifySuccess(trans(
                'cms::article.update.published', [
                'task' => $article->published ? 'published' : 'unpublished',
            ])
        );
    }

    /**
     * Publish/Unpublish a article.
     *
     * @param \Yajra\CMS\Entities\Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function featured(Article $article)
    {
        $article->toggleFeaturedState();

        return $this->notifySuccess(trans(
                'cms::article.update.featured', [
                'task' => $article->published ? 'featured' : 'unfeatured',
            ])
        );
    }
}

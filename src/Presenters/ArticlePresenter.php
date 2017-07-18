<?php

namespace Yajra\CMS\Presenters;

use Laracasts\Presenter\Presenter;

class ArticlePresenter extends Presenter
{
    /**
     * Edit link of the article.
     *
     * @return string
     */
    public function editLink()
    {
        return html()->linkRoute('administrator.articles.edit', $this->introTitle(), $this->entity->id);
    }

    /**
     * Article's limited introduction title.
     *
     * @param int    $limit
     * @param string $end
     * @return string
     */
    public function introTitle($limit = 50, $end = '...')
    {
        return str_limit($this->entity->title, $limit, $end);
    }

    /**
     * Date created.
     *
     * @return string
     */
    public function dateCreated()
    {
        return $this->entity->created_at->format('Y-m-d');
    }

    /**
     * Date published.
     *
     * @return mixed
     */
    public function datePublished()
    {
        return $this->entity->created_at->diffForHumans();
    }

    /**
     * Date modified.
     *
     * @return mixed
     */
    public function dateModified()
    {
        return $this->entity->updated_at->format('d M Y');
    }

    /**
     * Publication state.
     *
     * @return string
     */
    public function published()
    {
        $class = $this->entity->published ? 'fa fa-check-circle-o' : 'fa fa-circle-o';
        $state = $this->entity->published ? 'Published' : 'Unpublished';

        return html()->tag('i', '', ["class" => $class, "data-toggle" => "tooltip", "data-title" => $state]);
    }

    /**
     * Get article's author name.
     *
     * @return string
     */
    public function author()
    {
        return !empty($this->entity->author_alias)
            ? $this->entity->author_alias
            : $this->entity->createdByName;
    }

    /**
     * Get the article's content.
     *
     * @return string
     * @throws \Exception
     * @throws \Throwable
     */
    public function content()
    {
        return $this->entity->blade_template
            ? view($this->entity->blade_template, compact('article', $this->entity))->render()
            : $this->entity->body;
    }

    /**
     * Get the article's title.
     *
     * @return mixed
     */
    public function title()
    {
        $heading = null;
        if (session()->has('active_menu')) {
            $heading = session('active_menu')->param('page_heading');
        }

        return $heading ? $heading : $this->entity->title;
    }

    /**
     * Get article's slug.
     *
     * @return string
     */
    public function slug()
    {
        return $this->entity->slug;
    }

    /**
     * Get intro text.
     *
     * @return string
     */
    public function introText()
    {
        $body = explode('<hr id="system-readmore" />', $this->entity->body);

        if ($body[0] === $this->entity->body) {
            return '';
        }

        return $body[0];
    }

    /**
     * Get article intro image.
     *
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function introImage()
    {
        return $this->entity->param('intro_image') ? url($this->entity->param('intro_image')) : "";
    }

    /**
     * Get article fulltext image.
     *
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function articleImage()
    {
        return $this->entity->param('image_fulltext') ? url($this->entity->param('image_fulltext')) : "";
    }
}

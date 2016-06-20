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
        return html()->linkRoute('administrator.articles.edit', $this->entity->title, $this->entity->id);
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
        return $this->entity->created_at->format('d M Y');
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
        return ! empty($this->entity->author_alias)
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
}

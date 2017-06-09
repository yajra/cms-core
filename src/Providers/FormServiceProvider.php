<?php

namespace Yajra\CMS\Providers;

use Illuminate\Support\HtmlString;
use Illuminate\Support\ServiceProvider;
use Yajra\CMS\Entities\Category;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        form()->macro('categories', function ($name = 'category_id', $selected = null, $options = [], $placeholder = false) {
            $html = [];
            if ($placeholder) {
                $html[] = new HtmlString('<option value="">- Select Category -</option>');
            }

            Category::lists()->each(function (Category $category) use (&$html, $selected, $name) {
                $selected = form()->getValueAttribute($name, $selected);

                if (is_array($selected)) {
                    $selected = in_array($category->id, $selected) ? 'selected' : null;
                } else {
                    $selected = ((string) $category->id == (string) $selected) ? 'selected' : null;
                }

                $options = [
                    'value'      => $category->id,
                    'selected'   => $selected,
                    'data-alias' => $category->present()->name,
                ];

                $html[] = new HtmlString('<option ' . html()->attributes($options) . '>' . e($category->present()->name) . '</option>');
            });

            $list    = implode('', $html);
            $options = html()->attributes($options + ['name' => $name]);

            return new HtmlString("<select {$options}>{$list}</select>");
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

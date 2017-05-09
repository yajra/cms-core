@php
    /** @var \Illuminate\Support\Collection $categories */
    $categories = \Yajra\CMS\Entities\Category::root()->descendants()->pluck('title', 'id');
    $categories->prepend('All', 0);
@endphp
<div class="row">
    <div class="col-md-9">
        <div class="form-group {!! $errors->has('parameters[category_id]') ? 'has-error' : '' !!}">
            <label class="form-label-style block" for="parameters[category_id]">
                {{__('Category')}}
            </label>
            {!! form()->select('parameters[category_id]', $categories, $widget->param('category_id'), ['class' => 'select2 form-control']) !!}
            {!! $errors->first('parameters[category_id]', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {!! $errors->has('parameters[limit]') ? 'has-error' : '' !!}">
            <label class="form-label-style block" for="parameters[limit]">
                {{__('Limit')}}
            </label>
            {{ form()->text('parameters[limit]', $widget->param('limit') ?: 5, ['class' => 'form-control']) }}
            {!! $errors->first('parameters[limit]', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
</div>

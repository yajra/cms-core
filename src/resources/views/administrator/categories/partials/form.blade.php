<div class="row">
    <div class="col-md-6">
        <div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
            <label class="form-label-style" for="title">{{trans('cms::categories.form.fields.title')}}</label>
            {!! form()->input('text', 'title', null, ['id'=>'title','class'=>'form-control','placeholder'=>'Enter title here']) !!}
            {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {!! $errors->has('alias') ? 'has-error' : '' !!}">
            <label class="form-label-style" for="alias">{{trans('cms::categories.form.fields.alias')}}</label>
            {!! form()->input('text', 'alias', null, ['id'=>'alias','class'=>'form-control','placeholder'=>'Enter alias here']) !!}
            {!! $errors->first('alias', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {!! $errors->has('parent_id') ? 'has-error' : '' !!}">
            <label class="form-label-style" for="parent_id">{{trans('cms::categories.form.fields.parent_name')}}</label>
            {!! form()->select('parent_id', $category->getParentsList(), null,['class' => 'select2 form-control']) !!}
            {!! $errors->first('params', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group {!! $errors->has('description') ? 'has-error' : '' !!}">
            {!! form()->textarea('description', null, ['id'=>'description','class'=>'form-control','rows'=>3,'cols'=>10]) !!}
            {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-2">
        <div class="form-group {!! $errors->has('published') ? 'has-error' : '' !!}">
            <label class="form-label-style" for="published">{{trans('cms::categories.form.fields.published')}}</label>
            <br>
            {!! form()->checkbox('published', $value = 1, $checked = null, ['name' =>'published','id'=>'published','class'=>'form-control bootstrap-checkbox']) !!}
            {!! $errors->first('published', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {!! $errors->has('authenticated') ? 'has-error' : '' !!}">
            <label class="form-label-style" for="authenticated">{{trans('cms::categories.form.fields.auth')}}
                @tooltip('Requires authentication to access the category.')
            </label>
            <br>
            {!! form()->checkbox('authenticated', $value = 1, $checked = null, ['name' =>'authenticated','id'=>'authenticated','class'=>'form-control bootstrap-checkbox']) !!}
            {!! $errors->first('authenticated', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
</div>

@push('js-plugins')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.9/ckeditor.js"></script>
@endpush

@push('scripts')
<script>
    $(function () {
        CKEDITOR.replace('description', {
            filebrowserBrowseUrl: '/administrator/media/browse',
            filebrowserImageBrowseUrl: '/administrator/media/browse/images'
        });
    });
</script>
@endpush

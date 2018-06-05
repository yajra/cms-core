<div class="form-group {{ hasError('name') }}">
    <label class="form-label-style" for="name">{{trans('cms::tag.form.fields.name')}}</label>
    {!! form()->input('text', 'name', null, ['id'=>'name','class'=>'form-control','placeholder'=>'Enter name here']) !!}
    @error('name')
</div>
<div class="form-group {{ hasError('slug') }}">
    <label class="form-label-style" for="slug">{{trans('cms::tag.form.fields.slug')}}</label>
    {!! form()->input('text', 'slug', null, ['id'=>'slug','class'=>'form-control','placeholder'=>'Enter slug here']) !!}
    @error('slug')
</div>
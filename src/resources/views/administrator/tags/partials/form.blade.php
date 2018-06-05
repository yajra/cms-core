<div class="form-group {{ hasError('name') }}">
    <label class="form-label-style" for="name">{{trans('cms::tag.form.fields.name')}}</label>
    {!! form()->input('text', 'name', null, ['id'=>'name','class'=>'form-control','placeholder'=>'Enter name here']) !!}
    @error('name')
</div>

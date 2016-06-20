<div class="row">
    <div class="col-md-4">
        <div class="form-group {!! $errors->has('type') ? 'has-error' : '' !!}">
            <label class="form-label-style" for="type">{{trans('cms::lookup.create.type')}}</label>
            {!! form()->input('text', 'type', null, ['id'=>'type','class'=>'form-control','placeholder'=>trans('cms::lookup.create.type_placeholder')]) !!}
            {!! $errors->first('type', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {!! $errors->has('key') ? 'has-error' : '' !!}">
            <label class="form-label-style" for="key">{{trans('cms::lookup.create.key')}}</label>
            {!! form()->input('text', 'key', null, ['id'=>'key','class'=>'form-control','placeholder'=>trans('cms::lookup.create.key_placeholder')]) !!}
            {!! $errors->first('key', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {!! $errors->has('value') ? 'has-error' : '' !!}">
            <label class="form-label-style" for="alias">{{trans('cms::lookup.create.value')}}</label>
            {!! form()->input('text', 'value', null, ['id'=>'alias','class'=>'form-control','placeholder'=>trans('cms::lookup.create.value_placeholder')]) !!}
            {!! $errors->first('value', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-5">
        <div class="form-group {!! $errors->has('parameters') ? 'has-error' : '' !!}">
            <label class="form-label-style" for="parameters">{{trans('cms::lookup.create.parameters')}}</label>
            {!! form()->textarea('parameters', null, ['id'=>'parameters','class'=>'form-control','placeholder'=>trans('cms::lookup.create.parameters_placeholder'),'size' => '30x5', 'style' => 'height: 200px;']) !!}
            {!! $errors->first('parameters', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <br>
        <button class="btn btn-sm btn-default btn-block" id="get-json"><i class="fa fa-forward"></i> {{trans('cms::lookup.create.get')}}</button>
        <button class="btn btn-sm btn-default btn-block" id="set-json"><i class="fa fa-backward"></i> {{trans('cms::lookup.create.set')}}</button>
    </div>
    <div class="col-md-5">
        <div class="form-group {!! $errors->has('parameters') ? 'has-error' : '' !!}">
            <label class="form-label-style" for="jsoneditor">{{trans('cms::lookup.create.parameters_editor')}}</label>
            <div id="jsoneditor" style="height: 200px;"></div>
        </div>
    </div>
</div>

@push('js-plugins')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsoneditor/5.5.5/jsoneditor.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsoneditor/5.5.5/jsoneditor.min.js"></script>
@endpush

@push('scripts')
<script>
    $(function () {
        var container = document.getElementById("jsoneditor");
        var options = {
            mode: 'tree',
            theme: 'bootstrap3'
        };
        var editor = new JSONEditor(container, options);
        @if($lookup->parameters)
        editor.set({!! $lookup->parameters  !!});
        @endif

        $('#set-json').on('click', function (e) {
            e.preventDefault();
            var json = editor.get();
            $('#parameters').val(JSON.stringify(json, null, 2));
        });
        $('#get-json').on('click', function (e) {
            e.preventDefault();
            var json = $('#parameters').val();
            editor.set(JSON.parse(json));
        });
    });
</script>
@endpush

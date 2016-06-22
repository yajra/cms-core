&lt;div class="form-group {{ $errors-&gt;has('parameters[field_name]') ? 'has-error' : '' }}"&gt;
    &lt;label class="form-label-style block" for="parameters[field_name]"&gt;
        {{trans('cms::user.form.field.field_name')}}
        @tooltip('cms::user.form.tooltip.field_name')
    &lt;/label&gt;
    {{ form()-&gt;input('text', 'parameters[field_name]', $user-&gt;param('field_name'), ['class'=&gt;'form-control input-sm')]) }}
    {!! $errors-&gt;first('parameters[field_name]', '&lt;span class="help-block"&gt;:message&lt;/span&gt;') !!}
&lt;/div&gt;

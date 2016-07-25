<span class="input-group-btn">
    <button class="btn btn-default btn-flat disabled" type="button" style="cursor: default;"><i class="fa fa-eye"></i></button>
</span>
<input id="{{$options['id']}}" name="{{$name}}" type="text" class="form-control" disabled>
<span class="input-group-btn">
    <button class="btn btn-primary btn-flat" {{ $options['vueEvent'] }} type="button" style="border-radius: 0px">{{$options['label']}}</button>
</span>
<span class="input-group-btn">
    <button v-on:click="clearContent('{{$options['id']}}')"
            class="btn btn-default btn-flat"
            type="button"
            style="border-radius: 0px"
            data-toggle="tooltip"
            data-title="Clear"
            data-container="body"
            data-original-title=""
            title="">
        <i class="fa fa-close"></i>
    </button>
</span>
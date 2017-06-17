<div class="tab-pane hide" id="tab-{{$key}}">
    <form method="POST" v-on:submit.prevent="storeConfig('{{$key}}')">
        <div class="box box-solid">
            <div class="box-body">
                @include('administrator.configuration.partials.form.' . $key)
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary text-bold">
                    {{trans('cms::button.update')}}
                </button>
            </div>
        </div>
    </form>
</div>

<div class="tab-pane hide" id="tab-{{$key}}">
    <form method="POST" v-on:submit.prevent="onSubmit({{$vueKey}}, '{{$swalTitle}}')">
        <div class="box box-solid">
            <div class="box-body">
                @include($form)
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary text-bold">
                    Update
                </button>
            </div>
        </div>
    </form>
</div><!-- /.tab-pane -->
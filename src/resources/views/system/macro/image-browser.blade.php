@push('styles')
<style>
    #{{camel_case($options['id'])}}imageContainer {
        text-align: center !important;
        display: inline-block !important;
        width: 100% !important;
        margin: 0px !important;
        padding: 20px 0px !important;
        overflow-y: scroll !important;
        height: 250px !important;
        border: 1px solid #f1f1f1 !important;
    }

    #{{camel_case($options['id'])}}btnUp {
        width: 9% !important;
        display: inline-block !important;
    }

    #{{camel_case($options['id'])}}imageContainer {
        display: none;
        margin-top: 25px !important;
        width: 100% !important;
        padding: 10px !important;
        border: 1px solid #e0e0e0 !important;
    }

    .img-li {
        list-style: none !important;
        float: left !important;
        margin-bottom: 7px !important;
        margin-right: 6px !important;
    }

    #{{camel_case($options['id'])}}uploader {
        display: none;
    }
</style>
@endpush

<span id="{{camel_case($options['id'])}}-img-container" style="display: table-row;">
    <input type="hidden" id="currentActive">
    <input type="hidden" id="currentActiveUrl">
    <span class="input-group-btn">
        <button class="btn btn-default btn-flat disabled" type="button" style="cursor: default;">
            <i class="fa fa-eye"></i>
        </button>
    </span>
    <input id="{{$options['id']}}"
           name="{{$name}}"
           type="text"
           class="form-control"
           value="{{$selected}}"
           readonly>
    <span class="input-group-btn">
        <button class="btn btn-primary btn-flat"
                v-on:click="{{camel_case($options['id'])}}showBtn()"
                type="button"
                style="border-radius: 0px">
            {{$options['label']}}
        </button>
    </span>
    <span class="input-group-btn">
        <button v-on:click="{{camel_case($options['id'])}}clear()"
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
    <div class="modal fade" tabindex="-1" role="dialog" id="{{camel_case($options['id'])}}Modal">
    {!! Form::open(['url'=>'/administrator/media/upload/image','id'=>camel_case($options['id']).'imageUploadForm','method' => 'POST','files'=>true]) !!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Image Browser
                        <small>(Click image to select.)</small>
                    </h4>
                </div>
                <div class="modal-body" style="padding-top: 0px;">
                    <div class="row">
                    <div class="col-md-12">
                        <div class="box box-solid">
                            <div class="box-body no-padding">
                                <div>
                                    <ul class="nav nav-pills nav-stacked">
                                        <li class="active">
                                            <div style="padding: 8px 0px;">
                                                <span class="input-group-btn" style="width: 17%;float: left;">
                                                    <button class="btn btn-default btn-flat disabled" type="button" style="cursor: default;">
                                                        {{config('media.root_dir')}}
                                                    </button>
                                                </span>
                                                {!! form()->select('directory', $mediaDirectories, null, [
                                                    'id'        => camel_case($options['id']).'directories',
                                                    'class'     => 'form-control',
                                                    'style'     => 'width:74%; display:inline-block'
                                                ]) !!}
                                                <button id="{{camel_case($options['id'])}}btnUp"
                                                        v-on:click="{{camel_case($options['id'])}}selectUp"
                                                        type="button"
                                                        class="btn btn-primary">Up
                                                </button>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div><ul id="{{camel_case($options['id'])}}imageContainer"></ul></div>
                                <div>
                                    <ul class="nav nav-pills nav-stacked">
                                        <li class="active">
                                            <div>
                                                <div class="form-group" style="display: inline-block; width: 100%;">
                                                    <label for="category_id"
                                                           class="form-label-style block">Image URL</label>
                                                    {!! form()->input('text', camel_case($options['id']).'imageUrl', null, ['id'=>camel_case($options['id']).'imageUrl','class'=>'form-control','placeholder'=>'Image url here.']) !!}
                                                </div>
                                                <div class="row" style="display: block; margin-bottom: 12px;">
                                                    <div class="col-md-6 text-left">
                                                        <button id="insert-img-btn"
                                                                type="button"
                                                                data-attr=""
                                                                v-on:click="{{camel_case($options['id'])}}Insert"
                                                                class="btn btn-primary">
                                                            Insert
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-default"
                                                                data-dismiss="modal"
                                                                aria-label="Close">Cancel
                                                        </button>
                                                    </div>
                                                    @can('media.create')
                                                        <div class="col-md-6 text-right">
                                                            <button v-on:click="{{camel_case($options['id'])}}showUploader"
                                                                    type="button"
                                                                    class="btn btn-default">
                                                            Upload New Image
                                                            </button>
                                                        </div>
                                                    @endcan
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="{{camel_case($options['id'])}}uploader">
                        <div class="col-md-6 text-left">
                            <input type="file" name="{{camel_case($options['id'])}}image" id="{{camel_case($options['id'])}}image">
                        </div>
                        <div class="col-md-6 text-right">
                            <button id="{{camel_case($options['id'])}}btnUploader" type="button" class="btn btn-danger">
                                <i class="fa fa-upload"></i>&nbsp;Start Upload
                            </button>
                            <button type="button"
                                    class="btn btn-default"
                                    v-on:click="{{camel_case($options['id'])}}hideUploader">Cancel
                            </button>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
    </div>
</span>
@push('scripts')
@include('administrator.partials.image-browser.script')
@endpush
@push('styles')
<style>
    #file-image-container {
        text-align: center !important;
        display: inline-block !important;
        width: 100% !important;
        margin: 0px !important;
        padding: 20px 0px !important;
        overflow-y: scroll !important;
        height: 250px !important;
        border: 1px solid #f1f1f1 !important;
    }

    #btn-up {
        width: 9% !important;
        display: inline-block !important;
    }

    #uploader-container {
        display: none;
        margin-top: 25px !important;
        width: 100% !important;
        padding: 10px !important;
        border: 1px solid #e0e0e0 !important;
    }
</style>
@endpush

<div class="modal fade" tabindex="-1" role="dialog" id="filebrowser-modal">
    {!! Form::open(['url'=>'/administrator/media/upload/image','id'=>'imageUploadForm','method' => 'POST','files'=>true]) !!}
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
                                                {!! form()->select('directory', $mediaDirectories, null, [
                                                    'id'        => 'mediaFiles',
                                                    'class'     => 'form-control',
                                                    'style'     => 'width:90%; display:inline-block'
                                                ]) !!}
                                                <button id="btn-up"
                                                        v-on:click="selectUp"
                                                        type="button"
                                                        class="btn btn-primary">Up
                                                </button>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <ul id="file-image-container"></ul>
                                </div>
                                <div>
                                    <ul class="nav nav-pills nav-stacked">
                                        <li class="active">
                                            <div style="padding: 8px;">
                                                <div class="form-group">
                                                    <label for="category_id"
                                                           class="form-label-style block">Image URL</label>
                                                    {!! form()->input('text', 'image_url', null, ['id'=>'image_url','class'=>'form-control','placeholder'=>'Image url here.']) !!}
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 text-left">
                                                        <button id="insert-img-btn"
                                                                type="button"
                                                                data-attr=""
                                                                v-on:click="InsetSelectedImage"
                                                                class="btn btn-primary">
                                                            Insert
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-default"
                                                                data-dismiss="modal"
                                                                aria-label="Close">Cancel
                                                        </button>
                                                    </div>
                                                    <div class="col-md-6 text-right">
                                                        <button v-on:click="showUploader"
                                                                type="button"
                                                                class="btn btn-default">
                                                            Upload New Image
                                                        </button>
                                                    </div>
                                                </div>
                                                <div id="uploader-container">
                                                    <div class="col-md-6 text-left">
                                                        <input type="file" name="image" id="image">
                                                    </div>
                                                    <div class="col-md-6 text-right">
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fa fa-upload"></i>&nbsp;Start Upload
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-default"
                                                                v-on:click="hideUploader">Cancel
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

@push('scripts')
<script>
    $(function () {
        new Vue({
            el: 'body',
            data: {},
            ready: function () {
                $('#mediaFiles').on('change', function () {
                    if ($(this).val()) {
                        var directory = $(this).val();
                    } else {
                        var directory = '/';
                    }
                    $.blockUI();
                    Vue.http.post('/administrator/media/browse/image', {'path': directory}).then(function (response) {
                        $('#file-image-container').html(response.data);
                        $.unblockUI();
                        $('#filebrowser-modal').modal('show');
                    });
                })
                $('#imageUploadForm').on('submit', (function (e) {
                    e.preventDefault();
                    $.blockUI();
                    var formData = new FormData(this);
                    $.ajax({
                        type: 'POST',
                        url: $(this).attr('action'),
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            $('#mediaFiles').val($('#mediaFiles').val()).change();
                            var fileInput = $('#image');
                            fileInput.replaceWith(fileInput.val('').clone(true));
                            $('#uploader-container').css('display', 'none');
                            $.unblockUI();
                            swal({
                                title: data.title,
                                text: data.text,
                                type: data.type,
                            });
                        },
                        error: function (data) {
                            response = JSON.parse(data.responseText);
                            swal({
                                title: "Oops!",
                                text: response.image[0],
                                type: "error",
                            });
                        }
                    });
                }));
            },
            methods: {
                showFileBrowser: function (input) {
                    $('#image_url').val('');
                    $('#mediaFiles').val('/').change();
                    $('#uploader-container').css('display', 'none');
                    $('#insert-img-btn').attr('data-attr', input);
                },
                selectUp: function () {
                    var $op = $('#mediaFiles option:selected'), $this = $(this);
                    if ($op.prev().val()) {
                        $('#mediaFiles').val($op.prev().val()).change();
                    }
                },
                InsetSelectedImage: function () {
                    var container = $('#insert-img-btn').attr('data-attr');
                    $('#' + container).val($('#image_url').val());
                    $('#filebrowser-modal').modal('hide');
                },
                clearContent: function (file) {
                    $('#' + file).val('');
                },
                showUploader: function () {
                    $('#uploader-container').css('display', 'inline-block');
                },
                hideUploader: function () {
                    $('#uploader-container').css('display', 'none');
                },
            }
        })
    });
    function selectFilename(file) {
        $('#mediaFiles').val(file).change();
    }
    function chooseImage(file) {
        $('#image_url').val('/images' + file)
    }
</script>
@endpush
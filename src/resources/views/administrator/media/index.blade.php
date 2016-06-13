@extends($template)

@section('body-class', '')

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css"/>
<style>.table-container {margin-top: 0 !important;}</style>
@endpush

@section('title')
    Media Manager | @parent
@stop

@section('page-title')
    @pageHeader('Media Manager', 'Manage site assets.', 'fa fa-file-image-o')
@stop

@section('content')
    <div class="row">
        <div class="col-md-3 col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="box-title"><i class="fa fa-server"></i> Directories</div>
                </div>
                <div class="box-body">
                    <strong>
                        <a href="{{ request()->url() }}">
                            <i class="fa fa-folder-open-o"></i> {{ $storage_root }}
                        </a>
                    </strong>
                    @include('administrator.media.partials.directories')
                </div>
            </div>
        </div>
        <div class="col-md-9 col-xs-12">
            @can('media.create')
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-body">
                            @include('administrator.media.partials.form')
                        </div>
                    </div>
                </div>
            </div>
            @endcan
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-body">
                            @include('administrator.media.partials.list')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js-plugins')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
@endpush

@push('scripts')
<script>
    var dropError = false;
    Dropzone.options.addPhotosForm = {
        maxFilesize: '{{ $max_file_size }}',
        acceptedFiles: '{{ $accepted_files }}',
        error: function (file, response) {
            dropError = true;
            if ($.type(response) === "string")
                var message = response; //dropzone sends it's own error messages in string
            else
                var message = response.message;
            file.previewElement.classList.add("dz-error");
            _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i];
                _results.push(node.textContent = message);
            }
            return _results;
        },
        queuecomplete: function () {
            if (dropError) console.log("There were errors!");
            else location.reload();
        }
    };

    (function ($) {
        $('#jstree_div').jstree();
        $('#jstree_div').on('ready.jstree', function () {
            $("#jstree_div").jstree("open_all");
        });
        $("#jstree_div li").on("click", "a", function () {
            $(location).attr('href', $(this).attr('href'))
        });

        // for CKEditor integration
        if (window.opener) {
            $('.media-insert-link').on('click', function () {
                var path = $(this).data('path');
                // Simulate user action of selecting a file to be returned to CKEditor.
                function returnFileUrl() {
                    var funcNum = 0;
                    window.opener.CKEDITOR.tools.callFunction(funcNum, path);
                    window.close();
                }

                returnFileUrl();
            });
        } else {
            // hide insert/select column
            $('.media-child-window').hide();
        }

        $('#media-table').DataTable({
            paginate: false,
            info: false,
            columnDefs: [
                {orderable: false, targets: [3, 4]}
                @cannot('media.delete')
                    ,{visible: false, targets: [4]}
                @endcannot
            ]
        });

        $('.img-preview').on('click', function (e) {
            e.preventDefault();
            $('#imagePreviewSrc').attr('src', '');
            $('#imagePreviewSrc').attr('src', $(this).data('imagesrc'));
        });

        $('.delete-single').on('click', function () {
            var fileName = $(this).data('name');
            var filePath = $(this).data('path');
            swal({
                title: "Are you sure you want to delete " + fileName + " ?",
                text: "You will not be able to recover this file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
                $.ajax({
                   url:  '{{ url('administrator/media/delete-media') }}',
                    data: {s: filePath},
                    type: 'POST',
                    dataType: 'json',
                    success: function (json) {
                        pushNotification(json);
                        window.location = '{{ request()->url() }}';
                    }
                });
            });
        });

        $('.btn-delete-media').on('click', function (e) {
            e.preventDefault();
            swal({
                title: "Are you sure you want to delete the selected file(/s) and folder(/s)?",
                text: "You will not be able to recover this file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
                $('#delete-media-form').submit();
            });
        });

    })(jQuery);
</script>
@endpush
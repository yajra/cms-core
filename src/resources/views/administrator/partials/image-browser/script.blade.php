<script type="text/javascript">
    $(function () {
        var attrId = '{{camel_case($options['id'])}}';
        var container = attrId + '-img-container';
        var modal = attrId + 'Modal';
        var fieldId = '{{$options['id']}}';
        new Vue({
            el: '#' + container,
            data: {},
            mounted: function () {
                $('#' + attrId + 'directories').on('change', function () {
                    if ($(this).val()) {
                        var directory = $(this).val();
                    } else {
                        var directory = '/';
                    }
                    $.blockUI();
                    Vue.http.post('/administrator/media/browse/image', {'path': directory}).then(function (response) {
                        $('#' + attrId + 'imageContainer').html(response.data);
                        $.unblockUI();
                    });
                });
                $('#' + attrId + 'btnUploader').on('click', (function () {
                    $.blockUI();
                    var file_data =  $('#'+attrId+'image').prop("files")[0];
                    var directory = $('#' + attrId + 'directories').val();
                    var data = new FormData(this);
                    data.append("file", file_data);
                    data.append("directory", directory);
                    $.ajax({
                        type: 'POST',
                        url: '/administrator/media/upload/image',
                        data: data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            $('#' + attrId + 'directories').val($('#' + attrId + 'directories').val()).change();
                            var fileInput = $('#'+attrId+'image');
                            fileInput.replaceWith(fileInput.val('').clone(true));
                            $('#' + attrId + 'uploader').css('display', 'none');
                            $.unblockUI();
                            swal({
                                title: data.title,
                                text: data.text,
                                type: data.type,
                            });
                        },
                        error: function (data) {
                            $.unblockUI();
                            response = JSON.parse(data.responseText);
                            swal({
                                title: "Oops!",
                                text: response.file[0],
                                type: "error",
                            });
                        }
                    });
                }));
            },
            methods: {
                {{camel_case($options['id'])}}showBtn: function () {
                    $('#currentActive').val(attrId);
                    if ($('#' + attrId + 'directories').val() == '/') {
                        $('#' + attrId + 'directories').val('/').change();
                        $('#' + modal).modal('show');
                    } else {
                        $('#' + modal).modal('show');
                    }
                },
                {{camel_case($options['id'])}}selectUp: function () {
                    var $op = $('#' + attrId + 'directories option:selected'), $this = $(this);
                    if ($op.prev().val()) {
                        $('#' + attrId + 'directories').val($op.prev().val()).change();
                    }
                },
                {{camel_case($options['id'])}}Insert: function () {
                    $('#' + fieldId).val($('#' + attrId + 'imageUrl').val());
                    $('#' + modal).modal('hide');
                },
                {{camel_case($options['id'])}}clear: function () {
                    $('#' + fieldId).val('');
                },
                {{camel_case($options['id'])}}showUploader: function () {
                    $('#' + attrId + 'uploader').css('display','block');
                },
                {{camel_case($options['id'])}}hideUploader: function () {
                    $('#' + attrId + 'uploader').css('display','none');
                }
            }
        })
    });
    function selectFilename(file) {
        var attrId = $('#currentActive').val() + 'directories';
        $('#' + attrId).val(file).change();
    }
    function chooseImage(file) {
        var attrId = $('#currentActive').val() + 'imageUrl';
        $('#' + attrId).val('/media' + file)
    }
</script>

<div class="form-group" id="form-addfolder">
    {!! form()->open(array('url' => 'administrator/media/add-folder', 'class'=>'form-inline')) !!}
    {!! form()->hidden('current_directory', $current_directory) !!}
    <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-folder-open"></i> {{ str_replace_first('public/','public/storage/', $current_directory) }}
            </span>
        {!! form()->text('new_directory', null, ['class'=>'form-control', 'style' => 'min-width: 220px', 'placeholder'=>'Enter folder name here']) !!}
    </div>
    {!! form()->button('<span class="fa fa-folder-open" aria-hidden="true"></span> &nbsp Create New Folder',
    array('class'=>'btn btn-primary','type'=>'submit')) !!}

    {!! form()->button('<span class="fa fa-plus" aria-hidden="true"></span> Upload',
        array('class'=>'btn btn-success', 'data-toggle'=>'collapse', 'data-target'=>'#form-addfile')) !!}
    {!! form()->close() !!}
</div>

<div class="form-group collapse" id="form-addfile">
    {!! form()->open(array('url' => 'administrator/media/add-file', 'id' => 'addPhotosForm', 'class'=> 'dropzone')) !!}
    {!! form()->hidden('current_directory', $current_directory) !!}
    {!! form()->close() !!}
</div>
<p>
    <strong>Accepted Files:</strong>
    <span class="label label-info">{{$accepted_files}}</span>

</p>
<p>
    <strong>Max File Size:</strong>
    <span class="label label-danger"> {{$max_file_size}}mb</span>
</p>


{!! form()->open(array('url' => 'administrator/media/delete-media', 'id' => 'delete-media-form')) !!}
@can('media.delete')
    {!! form()->button('<span class="fa fa-trash" aria-hidden="true"></span> Delete Selected Files/Folders', array('class'=>'btn pull-right btn-sm btn-danger btn-delete-media', 'type'=>'button')) !!}
@endcan

<table id="media-table" class="table display">
    <thead>
    <tr>
        <th width="20px"><i class="fa fa-eye"></i></th>
        <th>File Name</th>
        <th width="100px">File Size</th>
        <th width="40px" class="media-child-window">Insert</th>
        <th width="40px"><i class="fa fa-check-square"></i> <i class="fa fa-trash"></i></th>
    </tr>
    </thead>
    @foreach($items as $item)
        <tr>
            <td>
                @if($item['type'] == 'image')
                    <a href=""
                       class="img-preview"
                       data-toggle="modal"
                       data-target="#imagePreview"
                       data-imagesrc="{{$item['url']}}">
                        <img src="{{$item['thumbnail']}}" alt="{{$item['filename']}}">
                    </a>
                @else
                    <a href="{{ $item['url'] }}">
                        <i class="fa {{$item['icon']}}"></i>
                    </a>
                @endif
            </td>
            <td>
                @if($item['type'] == 'image')
                    <a href=""
                       class="img-preview"
                       data-toggle="modal"
                       data-target="#imagePreview"
                       data-imagesrc="{{$item['url']}}">
                        {{ $item['filename'] }}
                    </a>
                @else
                    <a href="{{ $item['url'] }}" {{$item['type']=='file' ? 'target="_blank"' : ''}}> {{ $item['filename'] }} </a>
                @endif
            </td>
            <td class="text-right" style="padding-right: 24px;">{{ $item['size'] ? bytesToHuman($item['size']) : '...'}}</td>
            <td class="media-child-window">
                @if($item['select'] && in_array($item['type'], ['file', 'image']))
                    <a href="#" class="btn btn-xs btn-default media-insert-link" data-path="{{$item['url']}}">
                        <i class="fa fa-check-circle" aria-hidden="true"></i> Select
                    </a>
                @endif
            </td>
            <td>
                @if($item['delete'])
                    @if($item['type'] === 'directory')
                        {!! form()->checkbox('directories[]', $item['path']) !!}
                    @else
                        {!! form()->checkbox('files[]', $item['path']) !!}
                    @endif
                    <a href="#"
                       class="delete-single btn btn-xs btn-danger"
                       data-path="{{$item['path']}}"
                       data-name="{{$item['filename']}}">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                @endif
            </td>
        </tr>
    @endforeach
</table>
{!! form()->close() !!}

<div id="imagePreview" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Preview</h4>
            </div>
            <div class="modal-body">
                <div id="image" style="text-align:center">
                    <img id="imagePreviewSrc" src="" alt="preview" style="max-width:100%; max-height:500px;">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('cms::button.close')}}</button>
            </div>
        </div>
    </div>
</div>

@foreach($mediaFiles as $file)
    @if($file['type'] == 'dir')
        <li style="list-style: none; float: left; margin-left: 23px; padding: 8px; margin-bottom: 7px;">
            <a href="javascript:void(0)" onclick="selectFilename('{{$file['filepath']}}')">
                <div style="height: 55px"><i class="fa fa-folder" style="font-size: 47px; color: #60c0d8; padding: 4px;"></i></div>
                <div><small>{{$file['filename']}}</small></div>
            </a>
        </li>
    @else
        <li style="list-style: none; float: left; margin-left: 23px; padding: 8px; border: 1px solid #e8e8e8; margin-bottom: 7px;">
            <a href="javascript:void(0)" onclick="chooseImage('{{$file['filepath']}}')">
                <div style="height: 55px"><img src="{{asset('/media/'.$file['filename'])}}" alt="" style="width: 50px"></div>
                <div><small>{{str_limit($file['filename'],8)}}</small></div>
            </a>
        </li>
    @endif
@endforeach

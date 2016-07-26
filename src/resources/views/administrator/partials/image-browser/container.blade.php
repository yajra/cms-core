@foreach($mediaFiles as $file)
    @if($file['type'] == 'dir')
        <li class="img-li" style=" border: 1px solid #fff; ">
            <a href="javascript:void(0)" onclick="selectFilename('{{$file['filepath']}}')">
                <div style="height: 55px; width: 70px;"><i class="fa fa-folder"
                                             style="font-size: 48px; color: #60c0d8; padding: 4px;"></i></div>
                <div style="padding-top: 17px; margin-bottom: 6px; display: inline-block;">
                    <small>{{$file['filename']}}</small>
                </div>
            </a>
        </li>
    @else
        <li class="img-li" style=" border: 1px solid #e8e8e8; ">
            <a href="javascript:void(0)" onclick="chooseImage('{{$file['filepath']}}')">
                <div style="height: 55px"><img src="{{asset('/media/'.$path.'/'.$file['filename'])}}" alt=""
                                               style="width: 70px"></div>
                <div style="padding-top: 17px; margin-bottom: 6px; display: inline-block;">
                    <small>{{str_limit($file['filename'],8)}}</small>
                </div>
            </a>
        </li>
    @endif
@endforeach

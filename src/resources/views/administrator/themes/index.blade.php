@extends('admin::layouts.master')

@section('title')
{{trans('cms::theme.title')}} | @parent
@endsection

@section('page-title')
    @pageHeader('cms::theme.title', 'cms::theme.description', 'cms::theme.icon')
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">
                <i class="fa fa-list"></i>&nbsp;{{trans('cms::theme.lists')}}
            </h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-striped table-bordered">
                <tr>
                    <th width="60px">{{trans('cms::theme.table.theme')}}</th>
                    <th>{{trans('cms::theme.table.name')}}</th>
                    <th>{{trans('cms::theme.table.description')}}</th>
                    <th>{{trans('cms::theme.table.version')}}</th>
                    <th width="20px">
                        <i class="fa fa-star" data-toggle="tooltip"
                           data-title="{{trans('cms::theme.table.default')}}"></i>
                    </th>
                    <th>{{trans('cms::theme.table.positions')}}</th>
                    <th width="80px">{{trans('cms::theme.table.action')}}</th>
                </tr>
                @foreach($themes as $theme)
                    <tr>
                        <td><span class="label label-success">{{$theme->theme}}</span></td>
                        <td>{{$theme->name}}</td>
                        <td>{{$theme->description}}</td>
                        <td>{{$theme->version}}</td>
                        <td>
                            @if($theme->isDefault())
                                <i class="fa fa-star text-green"></i>
                            @endif
                        </td>
                        <td>
                            <ul>
                                @foreach($theme->positions as $position)
                                    <li>{{$position}}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            @if(! $theme->isDefault())
                                {!! form()->open() !!}
                                {!! form()->hidden('theme', $theme->theme) !!}
                                <button type="submit" class="btn btn-xs btn-primary btn-block">
                                    <i class="fa fa-star"></i>
                                    {{trans('cms::theme.default')}}
                                </button>
                                {!! form()->close() !!}

                                <br>

                                {!! form()->open(['method' => 'delete', 'url' => route('administrator.themes.destroy', $theme->theme)]) !!}
                                {!! form()->hidden('theme', $theme->theme) !!}
                                <button type="button" class="btn btn-xs btn-danger btn-block btn-delete">
                                    <i class="fa fa-trash"></i>
                                    {{trans('cms::theme.uninstall')}}
                                </button>
                                {!! form()->close() !!}
                            @else
                                <button type="submit" disabled class="btn btn-xs btn-success btn-block">
                                    <i class="fa fa-star"></i>
                                    {{trans('cms::theme.current')}}
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop

@push('scripts')
<script>
    $(function () {
        $('.btn-delete').on('click', function (e) {
            var form = $(this).parents('form');
            e.preventDefault();
            swal({
                title: "{{trans('cms::theme.confirm.title')}}",
                text: "{{trans('cms::theme.confirm.text')}}",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "{{trans('cms::theme.confirm.cancel')}}",
                confirmButtonText: "{{trans('cms::theme.confirm.yes')}}",
                closeOnConfirm: false
            }, function () {
                form.submit();
            });
        });
    });
</script>
@endpush

@extends('layouts.master')

@section('title')
{{trans('cms::navigation.edit.title')}} | @parent
@endsection

@section('page-title')
    @pageHeader('cms::navigation.edit.title', 'cms::navigation.edit.description', 'cms::navigation.edit.icon')
@stop

@section('content')
    {!! form()->model($navigation, ['url' => route('administrator.navigation.update', $navigation->id), 'method' => 'PUT']) !!}
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{trans('cms::navigation.form_header')}}</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    @include('administrator.navigation.partials.form')
                </div>
                <div class="box-footer">
                    <a href="{{route('administrator.navigation.index')}}" class="btn btn-warning text-bold">
                        {{trans('cms::button.cancel')}}
                    </a>
                    <button type="submit" class="btn btn-primary text-bold">
                        {{trans('cms::button.update')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
    {!! form()->close() !!}
@stop


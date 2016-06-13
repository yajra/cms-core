@extends('admin::layouts.master')

@section('title')
{{trans('navigation.edit.title')}} | @parent
@endsection

@section('page-title')
    @pageHeader('navigation.edit.title', 'navigation.edit.description', 'navigation.edit.icon')
@stop

@section('content')
    {!! form()->model($navigation, ['url' => route('administrator.navigation.update', $navigation->id), 'method' => 'PUT']) !!}
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{trans('navigation.form_header')}}</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    @include('administrator.navigation.partials.form')
                </div>
                <div class="box-footer">
                    <a href="/administrator/navigation" class="btn btn-warning text-bold">
                        {{trans('button.cancel')}}
                    </a>
                    <button type="submit" class="btn btn-primary text-bold">
                        {{trans('button.update')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
    {!! form()->close() !!}
@stop


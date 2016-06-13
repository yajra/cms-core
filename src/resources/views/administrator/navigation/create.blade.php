@extends('admin::layouts.master')

@section('title')
{{trans('navigation.create.title')}} | @parent
@endsection

@section('page-title')
    @pageHeader('navigation.create.title', 'navigation.create.description', 'navigation.create.icon')
@stop

@section('content')
    {!! form()->model($navigation, ['url' => route('administrator.navigation.store')]) !!}
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 style="color: #505b69;" class="box-title">{{trans('navigation.form_header')}}</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    @include('administrator.navigation.partials.form')
                </div>
                <div class="box-footer">
                    <a href="/administrator/navigation" class="btn btn-warning text-bold text-uppercase">
                        {{trans('cms::button.cancel')}}
                    </a>
                    <button type="submit" class="btn btn-primary text-bold text-uppercase">
                        <i class="fa fa-check"></i> {{trans('cms::button.save')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
    {!! form()->close() !!}
@stop


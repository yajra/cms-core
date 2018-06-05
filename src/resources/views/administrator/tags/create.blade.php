@extends('layouts.master')

@section('title')
    {{trans('cms::tag.create.title')}} | @parent
@stop

@section('page-title')
    @pageHeader('cms::tag.create.page-title', 'cms::tag.create.page-desc', 'fa fa-plus')
@stop

@section('content')
    {!! form()->model($tag, ['url' => route('administrator.tags.store')]) !!}
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 style="color: #505b69;" class="box-title">{{trans('cms::navigation.form_header')}}</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    @include('administrator.tags.partials.form')
                </div>
                <div class="box-footer">
                    <a href="{{route('administrator.tags.index')}}" class="btn btn-warning text-bold text-uppercase">
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

@push('scripts')

@endpush

@extends('layouts.master')

@section('title')
    {{trans('cms::tag.edit.title')}} | @parent
@stop

@section('page-title')
    @pageHeader('cms::tag.edit.page-title', 'cms::tag.edit.page-desc', 'fa fa-edit')
@stop

@section('content')
    {!! form()->model($tag, ['url' => route('administrator.tags.update', $tag->id), 'method' => 'PUT']) !!}
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
                    @include('administrator.tags.partials.form')
                </div>
                <div class="box-footer">
                    <a href="{{route('administrator.tags.index')}}" class="btn btn-warning text-bold">
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

@push('scripts')

@endpush

@extends('admin::layouts.master')

@section('title')
    {{trans('cms::lookup.edit.title')}} | @parent
@stop

@section('page-title')
    @pageHeader(trans('cms::lookup.edit.page_title'), trans('cms::lookup.edit.description'), trans('cms::lookup.edit.icon'))
@stop

@section('content')
    {!! form()->model($lookup, ['url' => route('administrator.lookup.update', $lookup->id), 'method' => 'PUT']) !!}
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 style="color: #505b69;" class="box-title">{{trans('cms::lookup.edit.fillup')}}</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="box-body">
            @include('administrator.lookup.partials.form')
        </div>

        <div class="box-footer">
            <a href="{{ route('administrator.lookup.index') }}" class="btn btn-warning text-bold">
                {{trans('cms::lookup.edit.cancel')}}
            </a>
            <button type="submit" id="btnSave" class="btn btn-primary text-bold">
                {{trans('cms::lookup.edit.update')}}
            </button>
        </div>
    </div>
    {!! form()->close() !!}
@stop
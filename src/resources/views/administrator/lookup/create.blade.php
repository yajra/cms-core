@extends('admin::layouts.master')

@section('title')
    {{trans('cms::lookup.create.title')}} | @parent
@stop

@section('page-title')
    @pageHeader(trans('cms::lookup.create.page_title'), trans('cms::lookup.create.description'), trans('cms::lookup.create.icon'))
@stop

@section('content')
    {!! form()->model($lookup, ['url' => route('administrator.lookup.store')]) !!}
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 style="color: #505b69;" class="box-title">{{trans('cms::lookup.create.fillup')}}</h3>
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
                {{trans('cms::lookup.create.cancel')}}
            </a>
            <button type="submit" id="btnSave" class="btn btn-primary text-bold">
                {{trans('cms::lookup.create.save')}}
            </button>
        </div>
    </div>
    {!! form()->close() !!}
@stop

@push('scripts')

@endpush
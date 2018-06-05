@extends('layouts.master')

@section('title')
    {{trans('cms::tag.create.title')}} | @parent
@stop

@section('page-title')
    @pageHeader('cms::tag.create.page-title', 'cms::tag.create.page-desc', 'fa fa-plus')
@stop

@section('content')
    {!! form()->model($tag, ['url' => route('administrator.tags.store')]) !!}
    <div class="box box-primary">
        <div class="box-body">
            <a href="{{ route('administrator.tags.index') }}" class="btn btn-warning text-bold text-uppercase">
                {{trans('cms::button.cancel')}}
            </a>
            <button type="submit" class="btn btn-primary text-bold text-uppercase">
                <i class="fa fa-check"></i> {{trans('cms::button.save')}}
            </button>
        </div>
    </div>

    @include('administrator.tags.partials.form')

    {!! form()->close() !!}
@stop

@push('scripts')

@endpush

@extends('admin::layouts.master')

@section('title')
    {{trans('cms::categories.create.title')}} | @parent
@stop

@section('page-title')
    @pageHeader('cms::categories.create.page-title', 'cms::categories.create.page-desc', 'fa fa-plus')
@stop

@section('content')
    {!! form()->model($category, ['url' => route('administrator.categories.store')]) !!}
    <div class="box box-primary">
        <div class="box-body">
            <a href="{{ route('administrator.categories.index') }}" class="btn btn-warning text-bold text-uppercase">
                {{trans('cms::button.cancel')}}
            </a>
            <button type="submit" class="btn btn-primary text-bold text-uppercase">
                <i class="fa fa-check"></i> {{trans('cms::button.save')}}
            </button>
        </div>
    </div>

    @include('administrator.categories.partials.form')

    {!! form()->close() !!}
@stop

@push('scripts')

@endpush

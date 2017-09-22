@extends('layouts.master')

@section('title')
    {{trans('cms::categories.edit.title')}} | @parent
@stop

@section('page-title')
    @pageHeader('cms::categories.edit.page-title', 'cms::categories.edit.page-desc', 'fa fa-edit')
@stop

@section('content')
    {!! form()->model($category, ['url' => route('administrator.categories.update', $category->id), 'method' => 'PUT']) !!}
    <div class="box box-primary">
        <div class="box-body">
            <a href="{{ route('administrator.categories.index') }}" class="btn btn-warning text-bold">
                {{trans('cms::button.cancel')}}
            </a>
            <button type="submit" class="btn btn-primary text-bold">
                {{trans('cms::button.update')}}
            </button>
        </div>
    </div>

    @include('administrator.categories.partials.form')

    {!! form()->close() !!}
@stop

@push('scripts')

@endpush

@extends('layouts.master')

@section('title')
    {{trans('cms::tag.edit.title')}} | @parent
@stop

@section('page-title')
    @pageHeader('cms::tag.edit.page-title', 'cms::tag.edit.page-desc', 'fa fa-edit')
@stop

@section('content')
    {!! form()->model($tag, ['url' => route('administrator.tags.update', $tag->id), 'method' => 'PUT']) !!}
    <div class="box box-primary">
        <div class="box-body">
            <a href="{{ route('administrator.tags.index') }}" class="btn btn-warning text-bold">
                {{trans('cms::button.cancel')}}
            </a>
            <button type="submit" class="btn btn-primary text-bold">
                {{trans('cms::button.update')}}
            </button>
        </div>
    </div>

    @include('administrator.tags.partials.form')

    {!! form()->close() !!}
@stop

@push('scripts')

@endpush

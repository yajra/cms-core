@extends('admin::layouts.master')

@section('title')
    New Registry | @parent
@stop

@section('page-title')
    @pageHeader('New Lookup Registry', 'This is where you should add a new lookup.', 'fa fa-plus')
@stop

@section('content')
    {!! form()->model($lookup, ['url' => route('administrator.lookup.store')]) !!}
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 style="color: #505b69;" class="box-title">Fill-up all the required fields.</h3>
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
                Cancel
            </a>
            <button type="submit" id="btnSave" class="btn btn-primary text-bold">
                Save and Add
            </button>
        </div>
    </div>
    {!! form()->close() !!}
@stop

@push('scripts')

@endpush
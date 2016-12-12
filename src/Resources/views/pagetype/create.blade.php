@extends('cms::layouts.default-header')

@section('title')
@lang('cms::pagetype.create.title')
@stop

@section('description')
@lang('cms::pagetype.create.description')
@stop

@section('content')
<div class="l-wrapper">
    <div class="header header--page">
        <h3 class="hN">@lang('cms::pagetype.create.header')</h3>
    </div>
    @include('cms::includes.alert', [ 'errors' => $errors ])
    <form class="form js-confirm-form" id="form-details" action="{{ route('cms.pagetype.save') }}" method="post">
        @include('cms::pagetype.form', [ $form ])
        <div class="btn-group">
            <a href="{{ route('cms.pagetype.view') }}" class="btn btn--transparent" role="button">@lang('cms::pagetype.controls.cancel')</a>
            <button class="btn" type="submit">@lang('cms::pagetype.controls.save')</button>
        </div>
        {!! csrf_field() !!}
    </form>
</div>
@stop

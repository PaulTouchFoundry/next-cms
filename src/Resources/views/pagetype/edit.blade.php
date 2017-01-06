@extends('cms::layouts.default-header')

@section('title')
@lang('cms::pagetype.edit.title')
@stop

@section('description')
@lang('cms::pagetype.edit.description')
@stop

@section('content')
<div class="l-wrapper">
    <div class="header header--page">
        <h3 class="hN">@lang('cms::pagetype.edit.header') <b>{{ $pageType->label }}</b></h3>
    </div>
    @if (isset($errors))
        @include('cms::includes.alert', [ 'errors' => $errors ])
    @endif
    <form class="form js-confirm-form" id="form-details" action="{{ route('cms.pagetype.update', [ 'cmsPageType' => $pageType ]) }}" method="post">
        @include('cms::pagetype.form', [ $form ])
        <div class="btn-group">
            <a href="{{ route('cms.pagetype.view') }}" class="btn btn--icon btn--transparent u-pull--left"><span class="icon icon--left fa fa-chevron-left" title="Back" aria-hidden="true"></span>@lang('cms::pagetype.controls.back')</a>
            <button class="btn" type="submit">@lang('cms::pagetype.controls.update')</button>
        </div>
        {!! csrf_field() !!}
    </form>
    
    @can('cms.pagetype_delete')
    <form action="{{ route('cms.pagetype.delete', [ $pageType ]) }}" method="post">
        <hr class="hr" />
        <button type="submit" class="btn btn--icon btn--red"><span class="icon icon--left fa fa-trash-o" aria-hidden="true"></span>@lang('cms::pagetype.controls.delete')</button>
        <hr class="hr" />
        {!! csrf_field() !!}
    </form>
    @endcan
</div>
@stop

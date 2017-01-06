@extends('cms::layouts.default-header')

@section('title')
@lang('cms::page.create.title', [ 'type' => str_singular($type->label), ])
@stop

@section('content')
<div class="l-wrapper">
    <div class="header header--page">
        <h3 class="hN">@lang('cms::page.create.header', [ 'type' => str_singular($type->label), ])</h3>
        <div class="steps">
            <div class="step is-active">
                <a class="step__link">@lang('cms::messages.steps.details')</a>
            </div>
            <div class="step">
                <a class="step__link">@lang('cms::messages.steps.content')</a>
            </div>
        </div>
    </div>
    @if (isset($errors))
        @include('cms::includes.alert', [ 'errors' => $errors ])
    @endif
    <form class="form js-confirm-form js-media-upload-form" id="form-details" action="{{ route('cms.page.save', [ 'cmsType' => $type->slug ]) }}" method="post">
        @include('cms::page.form', [ $form, $type ])
        <div class="btn-group">
            <a href="{{ $type->pageUrl() }}" class="btn btn--transparent" role="button">@lang('cms::controls.cancel')</a>
            <button class="btn btn--icon" type="submit">@lang('cms::page.controls.next')<span class="icon fa fa-chevron-right" title="Next" aria-hidden="true"></span></button>
        </div>
        {!! csrf_field() !!}
    </form>
</div>

    @include('cms::includes.modals.media', ['tag' => 'hero',])
@stop

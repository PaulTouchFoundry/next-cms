@extends('cms::layouts.default-header')

@section('title')
@lang('cms::page.edit.title', [ 'type' => str_singular($type->label), ])
@stop

@section('content')
<div class="l-wrapper">
    <div class="header header--page">
        <h3 class="hN">@lang('cms::page.edit.header', [ 'type' => str_singular($type->label), ]) <b>{{ $page->name }}</b></h3>
        <div class="steps">
            <div class="step is-active is-complete">
                <a class="step__link" href="{{ $page->editUrl() }}"><span class="icon fa fa-check" title="Complete" aria-hidden="true"></span>@lang('cms::messages.steps.details')</a>
            </div>
            <div class="step is-complete">
                <a class="step__link" href="{{ $page->blockUrl() }}"><span class="icon fa fa-check" title="Complete" aria-hidden="true"></span>@lang('cms::messages.steps.content')</a>
            </div>
        </div>
    </div>
    @include('cms::includes.alert', [ 'errors' => $errors ])
    <form class="form js-confirm-form js-media-upload-form" id="form-details" action="{{ route('cms.page.update', [ 'cmsType' => $type->slug, 'cmsPage' => $page ]) }}" method="post">
        @include('cms::page.form', [ $form, $type ])
        <div class="btn-group">
            <a href="{{ $type->pageUrl() }}" class="btn btn--icon btn--transparent u-pull--left"><span class="icon icon--left fa fa-chevron-left" title="Back" aria-hidden="true"></span>@lang('cms::controls.cancel')</a>
            <button class="btn btn--bordered" type="submit">@lang('cms::page.controls.update', [ 'type' => str_singular($type->label), ])</button>
            <button name="next" class="btn btn--icon" type="submit" value="true">@lang('cms::page.controls.next')<span class="icon fa fa-chevron-right" title="Next" aria-hidden="true"></span></button>
        </div>
        {!! csrf_field() !!}
    </form>
    
    @can('cms.page_delete')
    <form action="{{ route('cms.page.delete', [ 'cmsType' => $type->slug, 'cmsPage' => $page ]) }}" method="post">
        <hr class="hr" />
        <button class="btn btn--icon btn--red" type="submit"><span class="icon icon--left fa fa-trash-o" aria-hidden="true"></span>@lang('cms::page.controls.delete', [ 'type' => str_singular($type->label), ])</button>
        <hr class="hr" />
        {!! csrf_field() !!}
    </form>
    @endcan
</div>

    @include('cms::includes.modals.media', ['tag' => 'hero',])
@stop

@extends('cms::layouts.default-header')

@section('title')
@lang('cms::block.create.title', [ 'type' => str_singular($type->label), ])
@stop

@section('content')
<div class="l-wrapper">
    <div class="header header--page">
        <h3 class="hN">@lang('cms::block.edit.header', [ 'type' => str_singular($type->label), ])</h3>
        <div class="steps">
            <div class="step is-complete">
                <a class="step__link" href="{{ $page->editUrl() }}"><span class="icon fa fa-check" aria-hidden="true"></span>@lang('cms::messages.steps.details')</a>
            </div>
            <div class="step is-active">
                <a class="step__link" href="{{ $page->blockUrl() }}"><span class="icon fa fa-check" title="Complete" aria-hidden="true"></span>@lang('cms::messages.steps.content')</a>
            </div>
        </div>
    </div>
    @include('cms::includes.alert', [ 'errors' => $errors ])
    <div class="l-section">
        <div class="l-content">
            {!! CMSForm::open([ 'url' => route('cms.block.update_block', ['cmsBlock' => $block,]), 'id' => 'form-block', 'class' => "form ".($page->publish?'js-form-published-warn':'') ]) !!}
            {!! CMSForm::input('hidden', 'page_id', $page->id) !!}
            <fieldset class="fieldset fieldset--bordered">
                <legend class="legend">@lang('cms::block.media_image.legend')</legend>
                <label class="label">File<span class="help-text">Recommended image dimension: 780px width or bigger</span></label>

                <div class="btn-group btn-group--left">
                    <a class="btn btn--small btn--bordered" href="#modal" data-toggle="modal" data-target="#modal" role="button">@lang('cms::page.fields.hero_image.select')</a>
                    <a class="btn btn--small" role="button" href="{{ route('cms.media.edit', ['tag' => 'block',]) }}">@lang('cms::page.fields.hero_image.manage')</a>
                </div>
                <div class="image js-media-select-preview{{ (is_null($block->media->first())?' u-hidden':'') }}">
                    <input class="input" name="media_id" type="hidden" value="{{ array_get($block->media->first(), 'id') }}">
                    <img src="{{ (!is_null($block->media->first())?$block->media->first()->getURL():'') }}" width="787" alt="" />
                    <a class="image__remove js-media-deselect" href="#"><span class="icon fa fa-minus" title="Remove" aria-hidden="true"></span></a>
                </div>

                <div class="btn-group">
                    <a href="{{ $page->blockUrl() }}" class="btn btn--transparent" role="button">@lang('cms::controls.cancel')</a>
                    {!! CMSForm::submit(trans('cms::block.media_image.controls.update')) !!}
                </div>
            </fieldset>
            {!! CMSForm::close() !!}
        </div>
    </div>

    <hr class="hr" />
    {!! CMSForm::open([ 'url' => route('cms.block.delete_block', [ 'cmsBlock' => $block, ]), 'method' => 'post' ]) !!}
    <button type="submit" class="btn btn--icon btn--red" role="button"><span class="icon icon--left fa fa-trash-o" aria-hidden="true"></span>@lang('cms::block.media_image.controls.delete')</button>
    {!! CMSForm::close() !!}
    <hr class="hr" />
</div>

@include('cms::includes.modals.media', ['tag' => 'block',])
@stop

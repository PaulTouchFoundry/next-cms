@extends('cms::layouts.default-header')

@section('title')
    @lang('cms::block.create.title', [ 'type' => str_singular($type->label), ])
@stop

@section('content')
    <div class="l-wrapper">
        <div class="header header--page">
            <h3 class="hN">@lang('cms::block.create.header', [ 'type' => str_singular($type->label), ])</h3>
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
                {!! CMSForm::open([ 'url' => route('cms.block.save_featured_block', ['cmsType' => $type->slug, 'cmsPage' => $page,]), 'id' => 'form-block' ]) !!}
                <fieldset class="fieldset fieldset--bordered">
                <legend class="legend">@lang('cms::block.featured.legend')</legend>
                <label class="label">File<span class="help-text">Recommended image dimension: 780px width or bigger</span></label>
                
                <div class="btn-group btn-group--left">
                    <a class="btn btn--small btn--bordered" href="#modal" data-toggle="modal" data-target="#modal" role="button">@lang('cms::page.fields.hero_image.select')</a>
                    <a class="btn btn--small" role="button" href="{{ route('cms.media.edit', ['tag' => 'block',]) }}">@lang('cms::page.fields.hero_image.manage')</a>
                </div>
                <div class="js-media-select-preview image u-hidden">
                    <input class="input" name="media_id" type="hidden">
                    <img src="" alt="" width="787">
                    <a class="image__remove js-media-deselect"><span class="icon fa fa-close" title="Remove" aria-hidden="true"></span></a>
                </div>

                    <div class="btn-group">
                        <a href="{{ $page->blockUrl() }}" class="btn btn--transparent" role="button">@lang('cms::controls.cancel')</a>
                        {!! CMSForm::submit(trans('cms::block.featured.controls.create')) !!}
                    </div>
                </fieldset>
                {!! CMSForm::close() !!}
            </div>
        </div>
    </div>

    @include('cms::includes.modals.media', ['tag' => 'block',])
@stop

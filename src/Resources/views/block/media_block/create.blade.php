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
        @if (isset($errors))
            @include('cms::includes.alert', [ 'errors' => $errors ])
        @endif
        <div class="l-section">
            <div class="l-content">
                {!! CMSForm::open([ 'url' => route('cms.block.save_media_image_block', ['cmsType' => $type->slug, 'cmsPage' => $page,]), 'id' => 'form-block' ]) !!}
                <fieldset class="fieldset fieldset--bordered">
                <legend class="legend">@lang('cms::block.media_image.legend')</legend>
                <label class="label">File<span class="help-text">Recommended image dimension: 780px width or bigger</span></label>
                
                <div class="btn-group btn-group--left">
                    <a class="btn btn--small btn--bordered" href="#modal" data-toggle="modal" data-target="#modal" role="button">@lang('cms::page.fields.hero_image.select')</a>
                    <a class="btn btn--small" role="button" href="{{ route('cms.media.edit', ['tag' => 'block',]) }}?from=block&page_id={{ $page->id }}">@lang('cms::page.fields.hero_image.manage')</a>
                </div>
                <?php
                if (!is_null(request('media_id'))) {
                    $media = Wearenext\CMS\Models\Media::find(request('media_id'));
                } else {
                    $media = null;
                }
                ?>
                <div class="image js-media-select-preview{{ (is_null($media)?' u-hidden':'') }}">
                    <input class="input" name="media_id" type="hidden" value="{{ data_get($media, 'id') }}">
                    <img src="{{ (!is_null($media)?$media->getURL():'') }}" width="787" alt="" />
                    <a class="image__remove js-media-deselect" href="#"><span class="icon fa fa-minus" title="Remove" aria-hidden="true"></span></a>
                </div>

                {!! CMSForm::wrapLabel('headline', trans('cms::block.media_image.fields.caption.label')) !!}
                {!! CMSForm::text('headline', null, [ 'placeholder' => trans('cms::block.media_image.fields.caption.placeholder') ]) !!}
                    <div class="btn-group">
                        <a href="{{ $page->blockUrl() }}" class="btn btn--transparent" role="button">@lang('cms::controls.cancel')</a>
                        {!! CMSForm::submit(trans('cms::block.media_image.controls.create')) !!}
                    </div>
                </fieldset>
                {!! CMSForm::close() !!}
            </div>
        </div>
    </div>

    @include('cms::includes.modals.media', ['tag' => 'block',])
@stop

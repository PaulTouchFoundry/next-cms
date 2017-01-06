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
                {!! CMSForm::open([ 'url' => route('cms.block.save_embed_block', ['cmsType' => $type->slug, 'cmsPage' => $page,]), 'id' => 'form-block' ]) !!}
                <fieldset class="fieldset fieldset--bordered">
                    <legend class="legend">@lang('cms::block.embed.legend')</legend>
                    {!! CMSForm::wrapLabel('content', trans('cms::block.embed.fields.content.label')) !!}
                    {!! CMSForm::textarea('content', null, [ 'autofocus' => 'autofocus', 'placeholder' => trans('cms::block.embed.fields.content.label') ]) !!}

                    <div class="btn-group">
                        <a href="{{ $page->blockUrl() }}" class="btn btn--transparent" role="button">@lang('cms::controls.cancel')</a>
                        {!! CMSForm::submit(trans('cms::block.embed.controls.create')) !!}
                    </div>
                </fieldset>
                {!! CMSForm::close() !!}
            </div>
        </div>
    </div>
@stop

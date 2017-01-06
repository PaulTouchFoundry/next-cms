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
                {!! CMSForm::open([ 'url' => route('cms.block.save_text_block', ['cmsType' => $type->slug, 'cmsPage' => $page,]), 'id' => 'form-block' ]) !!}
                <fieldset class="fieldset fieldset--bordered">
                    <legend class="legend">@lang('cms::block.text.legend')</legend>
                    {!! CMSForm::wrapLabel('headline', trans('cms::block.text.fields.headline.label')) !!}
                    {!! CMSForm::text('headline', null, [ 'placeholder' => trans('cms::block.text.fields.headline.placeholder'), 'autofocus' => 'autofocus' ]) !!}

                    @include('cms::includes.blocks.text_block.toolbar', [ $page ])
                    <label class="label" for="content">
                        {!! CMSForm::textarea('content', null, [ 'class' => 'input input--textarea js-wysihtml5', 'placeholder' => trans('cms::block.text.fields.content.placeholder'), 'style' => 'height: 500px' ] ) !!}
                    </label>

                    <button class="btn btn--bordered btn--small js-editortoggle" role="button" type="button">Show HTML</button>

                    {{--@if ((isset($showNavigation)?$showNavigation:true))
                        <label class="label label--checkbox" for="quicklink">
                            <input class="js-toggle-item" id="quicklink" name="quicklink" value="1" type="checkbox" data-toggle-id="title" data-input-focus="true" checked="checked">@lang('cms::block.text.fields.quicklink.label')
                        </label>
                        {!! CMSForm::wrapLabel('title', trans('cms::block.text.fields.title.label'), ['class' => 'label' . ((isset($errors) && $errors->get('title')) ? ' has-error' : ''), 'id' => 'title']) !!}
                        {!! CMSForm::text('title', null, [ 'placeholder' => trans('cms::block.text.fields.title.placeholder'), 'maxlength' => '25' ]) !!}
                    @endif--}}

                    <div class="btn-group">
                        <a href="{{ $page->blockUrl() }}" class="btn btn--transparent" role="button">@lang('cms::controls.cancel')</a>
                        {!! CMSForm::submit(trans('cms::block.text.controls.create')) !!}
                    </div>
                </fieldset>
                {!! CMSForm::close() !!}
            </div>
        </div>
    </div>
@stop

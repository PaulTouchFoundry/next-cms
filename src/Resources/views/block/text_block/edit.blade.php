@extends('cms::layouts.default-header')

@section('title')
    @lang('cms::block.edit.title', [ 'type' => str_singular($type->label), ])
@stop

@section('content')
    <div class="l-wrapper">
        <div class="header header--page">
            <h3 class="hN">@lang('cms::block.edit.header', [ 'type' => str_singular($type->label), ]) <b>{{ $page->name }}</b></h3>
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
                    <legend class="legend">@lang('cms::block.text.legend')</legend>
                    {!! CMSForm::wrapLabel('headline', trans('cms::block.text.fields.headline.label')) !!}
                    {!! CMSForm::text('headline', $block->headline, [ 'placeholder' => trans('cms::block.text.fields.headline.placeholder') ]) !!}

                    @include('cms::includes.blocks.text_block.toolbar', [ $page ])
                    <label class="label" for="content">
                        {!! CMSForm::textarea('content', $block->content, [ 'class' => 'input input--textarea js-wysihtml5', 'placeholder' => trans('cms::block.text.fields.content.placeholder'), 'style' => 'height: 500px' ] ) !!}
                    </label>

                    <button class="btn btn--bordered btn--small js-editortoggle" role="button" type="button">Show HTML</button>

                    {{--@if ((isset($showNavigation)?$showNavigation:true))
                        <label class="label label--checkbox" for="quicklink">
                            <input class="js-toggle-item" id="quicklink" name="quicklink" value="1" type="checkbox" data-toggle-id="title" {{ old('quicklink', $block->quicklink) ? 'checked="checked"' : '' }} data-input-focus="true">@lang('block.icon_list.fields.quicklink.label')
                        </label>
                        {!! Form::wrapLabel('title', trans('block.icon_list.fields.title.label'), ['class' => 'label' . ($errors->has('title') ? ' has-error' : '') . (old('quicklink') || $block->quicklink ? '' : ' u-hidden'), 'id' => 'title']) !!}
                        {!! Form::text('title', $block->title, [ 'placeholder' => trans('block.icon_list.fields.title.placeholder'), 'maxlength' => '25' ]) !!}
                    @endif--}}

                    <div class="btn-group">
                        <a href="{{ $page->blockUrl() }}" class="btn btn--transparent" role="button">@lang('cms::controls.cancel')</a>
                        {!! CMSForm::submit(trans('cms::block.text.controls.update')) !!}
                    </div>
                </fieldset>
                {!! CMSForm::close() !!}
            </div>
        </div>

        <hr class="hr" />
        {!! CMSForm::open([ 'url' => route('cms.block.delete_block', [ 'cmsBlock' => $block, ]), 'method' => 'post' ]) !!}
        <button type="submit" class="btn btn--icon btn--red" role="button"><span class="icon icon--left fa fa-trash-o" aria-hidden="true"></span>@lang('cms::block.text.controls.delete')</button>
        {!! CMSForm::close() !!}
        <hr class="hr" />
    </div>
@stop

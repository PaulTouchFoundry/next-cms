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
                    <legend class="legend">@lang('cms::block.embed.legend')</legend>
                    {!! CMSForm::wrapLabel('content', trans('cms::block.embed.fields.content.label')) !!}
                    {!! CMSForm::textarea('content', $block->content, [ 'placeholder' => trans('cms::block.embed.fields.content.placeholder') ]) !!}

                    <div class="btn-group">
                        <a href="{{ $page->blockUrl() }}" class="btn btn--transparent" role="button">@lang('cms::controls.cancel')</a>
                        {!! CMSForm::submit(trans('cms::block.embed.controls.update')) !!}
                    </div>
                </fieldset>

                {!! CMSForm::close() !!}
            </div>
        </div>

        <hr class="hr" />
        {!! CMSForm::open([ 'url' => route('cms.block.delete_block', [ 'cmsBlock' => $block, ]), 'method' => 'post' ]) !!}
        <button type="submit" class="btn btn--icon btn--red" role="button"><span class="icon icon--left fa fa-trash-o" aria-hidden="true"></span>@lang('cms::block.embed.controls.delete')</button>
        {!! CMSForm::close() !!}
        <hr class="hr" />
    </div>
@stop

@extends('cms::layouts.default-header')

@section('title')
    @lang('cms::callout.create.title', [ 'type' => str_singular($type->label), ])
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
            {!! CMSForm::open([ 'url' => route('cms.callout.save', ['cmsType' => $type->slug, 'cmsPage' => $page,]), 'id' => 'form-block' ]) !!}
                <fieldset class="fieldset fieldset--bordered">
                    <legend class="legend">@lang('cms::callout.legend')</legend>
                    <label class="label label--checkbox label--inline" for="checkbox-a">
                        {!! CMSForm::checkbox('uses[]', 'large_heading', false, [ 'id' => 'checkbox-a', 'class' => 'js-callout-toggle' ]) !!} @lang('cms::callout.fields.large_heading_checkbox.label')
                    </label>

                    <label class="label label--checkbox label--inline" for="checkbox-b">
                        {!! CMSForm::checkbox('uses[]', 'small_heading', false, [ 'id' => 'checkbox-b', 'class' => 'js-callout-toggle' ]) !!} @lang('cms::callout.fields.small_heading_checkbox.label')
                    </label>

                    <label class="label label--checkbox label--inline" for="checkbox-c">
                        {!! CMSForm::checkbox('uses[]', 'text', false, [ 'id' => 'checkbox-c', 'class' => 'js-callout-toggle' ]) !!} @lang('cms::callout.fields.paragraph_checkbox.label')
                    </label>

                    <label class="label label--checkbox label--inline" for="checkbox-e">
                        {!! CMSForm::checkbox('uses[]', 'quote', false, [ 'id' => 'checkbox-e', 'class' => 'js-callout-toggle' ]) !!} @lang('cms::callout.fields.quote_checkbox.label')
                    </label>

                    <label class="label label--checkbox label--inline" for="checkbox-f">
                        {!! CMSForm::checkbox('uses[]', 'button', false, [ 'id' => 'checkbox-f', 'class' => 'js-callout-toggle' ]) !!} @lang('cms::callout.fields.button_checkbox.label')
                    </label>

                    <label class="label js-callout-option u-hidden" data-option="large_heading" for="heading">
                        @lang('cms::callout.fields.large_heading.label')
                        {!! CMSForm::text('large_heading', null, [ 'id' => 'heading', 'placeholder' => trans('block.callout.fields.large_heading.placeholder') ]) !!}
                    </label>

                    <label class="label js-callout-option u-hidden" data-option="small_heading" for="small_heading">
                        @lang('block.callout.fields.small_heading.label')
                        {!! CMSForm::text('small_heading', null, [ 'id' => 'small_heading', 'placeholder' => trans('block.callout.fields.small_heading.placeholder') ]) !!}
                    </label>

                    <label class="label js-callout-option u-hidden" data-option="text" for="paragraph">
                        @lang('cms::callout.fields.paragraph.label')
                        {!! CMSForm::textarea('text', null, [ 'id' => 'paragraph', 'placeholder' => trans('cms::callout.fields.paragraph.placeholder') ]) !!}
                    </label>

                    <label class="label js-callout-option u-hidden" data-option="quote" for="quote">
                        @lang('cms::callout.fields.quote.label')
                        {!! CMSForm::text('quote', null, [ 'id' => 'quote', 'placeholder' => trans('cms::callout.fields.quote.placeholder') ]) !!}
                    </label>

                    <label class="label js-callout-option u-hidden" data-option="button" for="button">
                        @lang('cms::callout.fields.button.label')
                        {!! CMSForm::text('button', null, [ 'id' => 'button', 'placeholder' => trans('cms::callout.fields.button.placeholder'), 'maxlength' => 20, 'class' => 'input js-character-counter' ]) !!}
                        <span class="help-text help-text--right">
                            <span class="js-character-counter-output">20</span> characters remaining
                        </span>
                    </label>
              
                    <label class="label js-callout-option u-hidden" data-option="button" for="url">
                        @lang('cms::callout.fields.url.label')
                        {!! CMSForm::text('url', null, [ 'id' => 'url', 'placeholder' => trans('cms::callout.fields.url.placeholder') ]) !!}
                    </label>

                    @if (in_array('text', array_keys($type->blocks)))
                    {!! CMSForm::wrapLabel('block_id', trans('cms::callout.fields.block.label')) !!}
                        <select id="block_id" name="block_id" class="input input--select">
                            @foreach ($page->getBlockGenerator() as $block)
                                @if ($block->block_type == \Wearenext\CMS\Models\Block::TYPE_TEXT)
                                <option value="{{ $block->id }}">{{ $block->headline }}</option>
                                @endif
                            @endforeach
                        </select>
                    {!! CMSForm::closeWrapLabel('block_id') !!}
                    @endif

                    <div class="btn-group">
                        <a href="{{ $page->blockUrl() }}" class="btn btn--transparent" role="button">@lang('cms::controls.cancel')</a>
                        <button class="btn btn--green" type="submit">@lang('cms::controls.create', [ 'block' => trans('cms::callout.controls.create') ])</button>
                    </div>
                </fieldset>
                {!! CMSForm::close() !!}
            </div>
        </div>
    </div>
@stop

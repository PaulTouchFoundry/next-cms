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
        @if (isset($errors))
            @include('cms::includes.alert', [ 'errors' => $errors ])
        @endif
        <div class="l-section">
            <div class="l-content">
                {!! CMSForm::open([ 'url' => route('cms.callout.update', ['cmsType' => $type->slug, 'cmsPage' => $page, 'cmsCallout' => $callout,]), 'id' => 'form-block', 'class' => "form ".($page->publish?'js-form-published-warn':'') ]) !!}
                    <fieldset class="fieldset fieldset--bordered">
                        <legend class="legend">@lang('cms::callout.legend')</legend>
                        <label class="label label--checkbox label--inline" for="checkbox-a">
                            {!! CMSForm::checkbox('uses[]', 'large_heading', !is_null($callout->large_heading), [ 'id' => 'checkbox-a', 'class' => 'js-callout-toggle' ]) !!} @lang('cms::callout.fields.large_heading_checkbox.label')
                        </label>

                        <label class="label label--checkbox label--inline" for="checkbox-b">
                            {!! CMSForm::checkbox('uses[]', 'small_heading', !is_null($callout->small_heading), [ 'id' => 'checkbox-b', 'class' => 'js-callout-toggle' ]) !!} @lang('cms::callout.fields.small_heading_checkbox.label')
                        </label>

                        <label class="label label--checkbox label--inline" for="checkbox-c">
                            {!! CMSForm::checkbox('uses[]', 'text', !is_null($callout->text), [ 'id' => 'checkbox-c', 'class' => 'js-callout-toggle' ]) !!} @lang('cms::callout.fields.paragraph_checkbox.label')
                        </label>

                        <label class="label label--checkbox label--inline" for="checkbox-e">
                            {!! CMSForm::checkbox('uses[]', 'quote', !is_null($callout->quote), [ 'id' => 'checkbox-e', 'class' => 'js-callout-toggle' ]) !!} @lang('cms::callout.fields.quote_checkbox.label')
                        </label>

                        <label class="label label--checkbox label--inline" for="checkbox-f">
                            {!! CMSForm::checkbox('uses[]', 'button', !is_null($callout->button), [ 'id' => 'checkbox-f', 'class' => 'js-callout-toggle' ]) !!} @lang('cms::callout.fields.button_checkbox.label')
                        </label>

                        <label class="label js-callout-option{{ (is_null($callout->large_heading)?' u-hidden':'') }}" data-option="large_heading" for="heading">
                            @lang('cms::callout.fields.large_heading.label')
                            {!! CMSForm::text('large_heading', $callout->large_heading, [ 'id' => 'heading', 'placeholder' => trans('cms::callout.fields.large_heading.placeholder') ]) !!}
                        </label>

                        <label class="label js-callout-option{{ (is_null($callout->small_heading)?' u-hidden':'') }}" data-option="small_heading" for="small_heading">
                            @lang('cms::callout.fields.small_heading.label')
                            {!! CMSForm::text('small_heading', $callout->small_heading, [ 'id' => 'small_heading', 'placeholder' => trans('cms::callout.fields.small_heading.placeholder') ]) !!}
                        </label>

                        <label class="label js-callout-option{{ (is_null($callout->text)?' u-hidden':'') }}" data-option="text" for="paragraph">
                            @lang('cms::callout.fields.paragraph.label')
                            {!! CMSForm::textarea('text', $callout->text, [ 'id' => 'paragraph', 'placeholder' => trans('cms::callout.fields.paragraph.placeholder') ]) !!}
                        </label>

                        <label class="label js-callout-option{{ (is_null($callout->quote)?' u-hidden':'') }}" data-option="quote" for="quote">
                            @lang('cms::callout.fields.quote.label')
                            {!! CMSForm::text('quote', $callout->quote, [ 'id' => 'quote', 'placeholder' => trans('cms::callout.fields.quote.placeholder') ]) !!}
                        </label>

                        <label class="label js-callout-option{{ (is_null($callout->button)?' u-hidden':'') }}" data-option="button" for="button">
                            @lang('cms::callout.fields.button.label')
                            {!! CMSForm::text('button', $callout->button, [ 'id' => 'button', 'placeholder' => trans('cms::callout.fields.button.placeholder'), 'maxlength' => 20, 'class' => 'input js-character-counter' ]) !!}
                            <span class="help-text help-text--right">
                                <span class="js-character-counter-output">{{ (20-strlen($callout->button)) }}</span> characters remaining
                            </span>
                        </label>

                        <label class="label js-callout-option{{ (is_null($callout->url)?' u-hidden':'') }}" data-option="button" for="url">
                            @lang('cms::callout.fields.url.label')
                            {!! CMSForm::text('url', $callout->url, [ 'id' => 'url', 'placeholder' => trans('cms::callout.fields.url.placeholder') ]) !!}
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
                            {!! CMSForm::submit(trans('cms::callout.controls.update')) !!}
                        </div>
                    </fieldset>
                {!! CMSForm::close() !!}
            </div>
        </div>

        <hr class="hr" />
        {!! CMSForm::open([ 'url' => route('cms.callout.delete', ['cmsType' => $type->slug, 'cmsPage' => $page, 'cmsCallout' => $callout,]), 'method' => 'post' ]) !!}
        <button type="submit" class="btn btn--icon btn--red" role="button"><span class="icon icon--left fa fa-trash-o" aria-hidden="true"></span>@lang('cms::callout.controls.delete')</button>
        {!! CMSForm::close() !!}
        <hr class="hr" />
    </div>
@stop


            
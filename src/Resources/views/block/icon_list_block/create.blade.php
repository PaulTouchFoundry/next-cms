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
                {!! CMSForm::open([ 'url' => route('cms.block.save_icon_list_block', ['cmsType' => $type->slug, 'cmsPage' => $page,]), 'id' => 'form-block', 'class' => "form ".($page->publish?'js-form-published-warn':'') ]) !!}
                <fieldset class="fieldset fieldset--bordered">
                    <legend class="legend">@lang('cms::block.icon_list.legend')</legend>
                    {!! CMSForm::wrapLabel('headline', trans('cms::block.icon_list.fields.headline.label')) !!}
                    {!! CMSForm::text('headline', null, [ 'placeholder' => trans('cms::block.icon_list.fields.headline.placeholder'), 'autofocus' => 'autofocus' ]) !!}

                    <div class="icons-list">
                        <label class="label">@lang('cms::block.icon_list.fields.icon-option.label')</label>
                        @include('cms::includes.blocks.icon_list.icon-option', [ 'removable' => false, 'id' => 0, 'item' => [ 'text' => '', 'class' => '' ] ])
                    </div>

                    <button class="btn btn--bordered btn--icon btn--small js-icon-list-entry-add" type="button" role="button">
                        <span class="icon icon--left fa fa-plus" title="Add" aria-hidden="true"></span>
                        List Item
                    </button>

                    {{--@if ((isset($showNavigation)?$showNavigation:true))
                        <hr class="hr" />
                        <label class="label label--checkbox" for="quicklink"><input class="js-toggle-item" id="quicklink" name="quicklink" value="1" type="checkbox" data-toggle-id="title" checked="checked" data-input-focus="true">@lang('block.icon_list.fields.quicklink.label')</label>
                        {!! Form::wrapLabel('title', trans('block.icon_list.fields.title.label'), [ 'class' => 'label', 'id' => 'title', ]) !!}
                        {!! Form::text('title', null, [ 'placeholder' => trans('block.icon_list.fields.title.placeholder'), 'maxlength' => '25' ]) !!}
                    @endif--}}

                    <div class="btn-group">
                        <a href="{{ $page->blockUrl() }}" class="btn btn--transparent" role="button">@lang('cms::controls.cancel')</a>
                        {!! CMSForm::submit(trans('cms::block.icon_list.controls.create')) !!}
                    </div>
                </fieldset>
                {!! CMSForm::close() !!}
            </div>
        </div>
    </div>
@stop

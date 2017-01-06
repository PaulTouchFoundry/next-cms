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
                {!! CMSForm::open([ 'url' => route('cms.block.update_block', ['cmsBlock' => $block,]), 'id' => 'form-block', 'class' => "form ".($page->publish?'js-form-published-warn':'') ]) !!}
                {!! CMSForm::input('hidden', 'page_id', $page->id) !!}
                <fieldset class="fieldset fieldset--bordered">
                    <legend class="legend">@lang('cms::block.icon_list.legend')</legend>
                    {!! CMSForm::wrapLabel('headline', trans('cms::block.icon_list.fields.headline.label')) !!}
                    {!! CMSForm::text('headline', $block->headline, [ 'placeholder' => trans('cms::block.icon_list.fields.headline.placeholder'), 'autofocus' => 'autofocus' ]) !!}

                    <div class="icons-list js-icons-list">
                        <label class="label">@lang('cms::block.icon_list.fields.icon-option.label')</label>
                        @if (is_array($block->icon_list))
                            @foreach ($block->icon_list AS $key => $icon)
                                @include('cms::includes.blocks.icon_list.icon-option', [ 'removable' => true, 'id' => $key, 'item' => $icon ])
                            @endforeach
                        @endif
                        @include('cms::includes.blocks.icon_list.icon-option', [ 'removable' => false, 'id' => count($block->icon_list), 'item' => [ 'text' => '', 'class' => '' ] ])
                    </div>

                    <button class="btn btn--bordered btn--icon btn--small js-icon-list-entry-add" type="button" role="button">
                        <span class="icon icon--left fa fa-plus" title="Add" aria-hidden="true"></span>
                        List Item
                    </button>

                   {{-- @if ((isset($showNavigation)?$showNavigation:true))
                        <hr class="hr" />
                        <label class="label label--checkbox" for="quicklink"><input class="js-toggle-item" id="quicklink" name="quicklink" value="1" type="checkbox" data-toggle-id="title" checked="checked" data-input-focus="true">@lang('block.icon_list.fields.quicklink.label')</label>
                        {!! Form::wrapLabel('title', trans('block.icon_list.fields.title.label'), [ 'class' => 'label', 'id' => 'title', ]) !!}
                        {!! Form::text('title', null, [ 'placeholder' => trans('block.icon_list.fields.title.placeholder'), 'maxlength' => '25' ]) !!}
                    @endif--}}

                    <div class="btn-group">
                        <a href="{{ $page->blockUrl() }}" class="btn btn--transparent" role="button">@lang('cms::controls.cancel')</a>
                        {!! CMSForm::submit(trans('cms::block.icon_list.controls.update')) !!}
                    </div>
                </fieldset>
                {!! CMSForm::close() !!}
            </div>
        </div>

        <hr class="hr" />
        {!! CMSForm::open([ 'url' => route('cms.block.delete_block', [ 'cmsBlock' => $block, ]), 'method' => 'post' ]) !!}
        <button type="submit" class="btn btn--icon btn--red" role="button"><span class="icon icon--left fa fa-trash-o" aria-hidden="true"></span>@lang('cms::block.icon_list.controls.delete')</button>
        {!! CMSForm::close() !!}
        <hr class="hr" />
    </div>
@stop

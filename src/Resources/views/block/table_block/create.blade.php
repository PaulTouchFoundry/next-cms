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
                {!! CMSForm::open([ 'url' => route('cms.block.save_table_block', ['cmsType' => $type->slug, 'cmsPage' => $page,]), 'id' => 'form-block' ]) !!}
                <fieldset class="fieldset fieldset--bordered">
                    <legend class="legend">@lang('cms::block.table.legend')</legend>
                    
                    {!! CMSForm::wrapLabel('headline', trans('cms::block.table.fields.headline.label')) !!}
                    {!! CMSForm::text('headline', null, [ 'placeholder' => trans('cms::block.table.fields.headline.placeholder'), 'autofocus' => 'autofocus' ]) !!}
                    
                    <div class="js-table-editor">
                        <caption class="table__caption">Editable table click to edit contents</caption>
                        <table class="table">
                            <thead>
                            <tr></tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        
                        {!! CMSForm::wrapLabel('table-editor-rows', trans('cms::block.table.fields.rows.label')) !!}
                        {!! CMSForm::number('table-editor-rows', '2', [ 'placeholder' => trans('cms::block.table.fields.rows.placeholder') ]) !!}
                        
                        {!! CMSForm::wrapLabel('table-editor-cols', trans('cms::block.table.fields.cols.label')) !!}
                        {!! CMSForm::number('table-editor-cols', '3', [ 'placeholder' => trans('cms::block.table.fields.cols.placeholder') ]) !!}
                        
                        {!! CMSForm::hidden('content', '[]', [ 'class' => 'js-table-editor-output' ]) !!}
                        {!! CMSForm::button(trans('cms::block.table.controls.resize'), ['class' => 'js-table-resize btn btn--small btn--bordered',]) !!}
                    </div>

                    <div class="btn-group">
                        <a href="{{ $page->blockUrl() }}" class="btn btn--transparent" role="button">@lang('cms::controls.cancel')</a>
                        {!! CMSForm::submit(trans('cms::block.table.controls.create')) !!}
                    </div>
                </fieldset>
                {!! CMSForm::close() !!}
            </div>
        </div>
    </div>
@stop

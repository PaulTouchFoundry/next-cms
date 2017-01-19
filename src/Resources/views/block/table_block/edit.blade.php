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
                {!! CMSForm::open([ 'url' => route('cms.block.update_block', ['cmsBlock' => $block,]), 'id' => 'form-block' ]) !!}
                <fieldset class="fieldset fieldset--bordered">
                    <legend class="legend">@lang('cms::block.table.legend')</legend>
                    
                    <?php
                    $table = json_decode($block->content, true);
                    if (!is_array($table)) {
                        $table = [];
                    }
                    ?>
                    
                    <div class="js-table-editor">
                        <caption class="table__caption">Editable table click to edit contents</caption>
                        <table class="table">
                            <thead>
                                <tr>
                                @foreach (array_get($table, 0, []) as $th)
                                <th>{{ $th }}</th>
                                @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($table as $i => $tr)
                                
                                @unless ($i == 0)
                                <tr>
                                    @foreach ($tr as $td)
                                    <td>{{ $td }}</td>
                                    @endforeach
                                </tr>
                                @endunless
                                
                                @endforeach
                            </tbody>
                        </table>
                        
                        {!! CMSForm::wrapLabel('table-editor-rows', trans('cms::block.table.fields.rows.label')) !!}
                        {!! CMSForm::number('table-editor-rows', count($table), [ 'placeholder' => trans('cms::block.table.fields.rows.placeholder') ]) !!}
                        
                        {!! CMSForm::wrapLabel('table-editor-cols', trans('cms::block.table.fields.cols.label')) !!}
                        {!! CMSForm::number('table-editor-cols', count(array_get($table, 0, [])), [ 'placeholder' => trans('cms::block.table.fields.cols.placeholder') ]) !!}
                        
                        {!! CMSForm::hidden('content', $block->content, [ 'class' => 'js-table-editor-output' ]) !!}
                        {!! CMSForm::button(trans('cms::block.table.controls.resize'), ['class' => 'js-table-resize btn btn--small btn--bordered',]) !!}
                    </div>

                    <div class="btn-group">
                        <a href="{{ $page->blockUrl() }}" class="btn btn--transparent" role="button">@lang('cms::controls.cancel')</a>
                        {!! CMSForm::submit(trans('cms::block.table.controls.update')) !!}
                    </div>
                </fieldset>
                {!! CMSForm::close() !!}
            </div>
        </div>

        <hr class="hr" />
        {!! CMSForm::open([ 'url' => route('cms.block.delete_block', [ 'cmsBlock' => $block, ]), 'method' => 'post' ]) !!}
        <button type="submit" class="btn btn--icon btn--red" role="button"><span class="icon icon--left fa fa-trash-o" aria-hidden="true"></span>@lang('cms::block.table.controls.delete')</button>
        {!! CMSForm::close() !!}
        <hr class="hr" />
    </div>
@stop

@extends('cms::layouts.default-header')

@section('title')
@lang('cms::block.index.title', [ 'type' => str_singular($type->label), ])
@stop

@section('content')
<div class="l-wrapper">
    <div class="header header--page">
        <h3 class="hN">@lang('cms::block.index.header', [ 'type' => str_singular($type->label), ]) <b>{{ $page->name }}</b></h3>
        <div class="steps">
            <div class="step is-complete">
                <a class="step__link" href="{{ $page->editUrl() }}"><span class="icon fa fa-check" aria-hidden="true"></span>@lang('cms::messages.steps.details')</a>
            </div>
            <div class="step is-active">
                <a class="step__link"><span class="icon fa fa-check" title="Complete" aria-hidden="true"></span>@lang('cms::messages.steps.content')</a>
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('cms.block.update', [ 'cmsType' => $type->slug, 'cmsPage' => $page, ]) }}" id="form-details" class="form">
        <div class="l-section">
            <div class="l-content">
                <div class="btn-group btn-group--left">
                    @foreach (array_keys($type->blocks) as $block)
                    <a href="{{ route("cms.block.create_{$block}_block", [ 'cmsType' => $type->slug, 'cmsPage' => $page, ]) }}" class="btn btn--bordered btn--icon btn--small"><span class="icon icon--left fa fa-plus" title="Add" aria-hidden="true"></span>@lang("cms::block.{$block}.label")</a>
                    @endforeach
                    
                    @if ($type->callout)
                    <a href="{{ route("cms.callout.create", [ 'cmsType' => $type->slug, 'cmsPage' => $page, ]) }}" class="btn btn--bordered btn--icon btn--small"><span class="icon icon--left fa fa-plus" title="Add" aria-hidden="true"></span>@lang("cms::callout.label")</a>
                    @endif
                </div>
                @foreach ($blocks as $block)
                    @include("cms::block.{$block->block_type}_block.view", [ $type, $page, $block ])
                @endforeach
            </div>
        </div>
        <div class="btn-group">
            <button class="btn btn--bordered">@lang('cms::block.controls.save')</button>
            <a href="{{ $page->previewUrl() }}" class="btn btn--icon" target="_blank">@lang('cms::block.controls.preview', [ 'type' => str_singular($type->label), ])<span class="icon fa fa-external-link" aria-hidden="true"></span></a>
        </div>
        {{ csrf_field() }}
    </form>

    @can('cms.page_destroy')
    {!! CMSForm::open([ 'url' => route('cms.page.delete', [ 'cmsType' => $type->slug, 'cmsPage' => $page ]), 'method' => 'post' ]) !!}
    <hr class="hr" />
    <button type="submit" class="btn btn--icon btn--red" role="button"><span class="icon icon--left fa fa-trash-o" aria-hidden="true"></span>@lang('cms::page.controls.delete', [ 'type' => str_singular($type->label), ])</button>
    <hr class="hr" />
    {!! CMSForm::close() !!}
    @endcan
</div>
@stop
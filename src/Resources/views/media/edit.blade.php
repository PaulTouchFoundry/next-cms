@extends('cms::layouts.default-header')

@section('title')
@lang('cms::media.create.title')
@stop

@section('description')
@lang('cms::media.create.description')
@stop

@section('content')
<div class="l-wrapper">
    @include('cms::includes.alert', [ 'errors' => $errors ])
    <div class="l-section">
        <div class="l-content">
            {!! CMSForm::open([ 'url' => route('cms.media.update'), 'id' => 'form-block', 'enctype' => 'multipart/form-data', 'class' => "form" ]) !!}
            {!! CMSForm::input('hidden', 'tag', $tag) !!}
            <fieldset class="fieldset fieldset--bordered">
                <legend class="legend">Upload media</legend>
                <div class="btn-group btn-group--left">
                    {!! CMSForm::file('media_file', [ 'class' => 'js-media-input' ]) !!}
                    <a class="btn btn--transparent" href="#modal" data-toggle="modal" data-target="#modal" role="button">Choose a image to replace</a>
                </div>
                <div class="js-media-select-preview image u-hidden">
                    {!! CMSForm::input('hidden', 'media_id', '') !!}
                    <img src="" width="787" alt="">
                    <a class="image__remove js-media-deselect"><span class="icon fa fa-close" title="Remove" aria-hidden="true"></span></a>
                </div>

                <div class="btn-group">
                    <a href="#" class="btn btn--icon btn--transparent u-pull--left" role="button"><span class="icon icon--left fa fa-chevron-left" title="Back" aria-hidden="true"></span>Back</a>
                    {!! CMSForm::submit("Upload Media") !!}
                </div>
            </fieldset>
            {!! CMSForm::close() !!}
        </div>
    </div>
</div>

    @include('cms::includes.modals.media', ['tag' => $tag,])
@stop

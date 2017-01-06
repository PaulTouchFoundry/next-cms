@extends('cms::layouts.default-header')

@section('title')
@lang('cms::page.view.title', ['type' => str_plural($type->label),])
@stop

@section('content')
<div class="l-wrapper">
    <div class="header header--page">
        <h3 class="hN">@lang('cms::page.view.header', ['type' => str_plural($type->label),])</h3>
        <div class="header-actions">
            @can('cms.page_create')
            <a class="btn btn--icon" href="{{ route('cms.page.create', [ 'cmsType' => $type->slug ]) }}" role="button"><span class="icon icon--left fa fa-plus" title="Add" aria-hidden="true"></span> @lang('cms::page.controls.create', ['type' => str_singular($type->label),])</a>
            @endcan
            
            <form class="form form--search" id="form-search" action="{{ route('cms.page.view', [ 'cmsType' => $type->slug ]) }}" method="get">
                <label class="u-visuallyhidden" for="search">@lang('cms::pagetype.fields.search.label')</label>
                <input class="input" type="text" id="search" name="{{ $searchForm->field('q')->name() }}" placeholder="@lang('cms::page.fields.search.placeholder')" maxlength="20" value="{{ $searchForm->field('q')->value() }}">
                <button class="btn btn--transparent btn--icon" type="submit"><span class="icon icon--only fa fa-search" aria-hidden="true"></span></button>
            </form>
            
        </div>
    </div>

    @if (isset($errors))
        @include('cms::includes.alert', [ 'errors' => $errors ])
    @endif
    
    @if (!empty($searchForm->field('q')->value('')))
    <p>{{ $pages->total() }} search {{ str_plural('result', $pages->total()) }} for <b>{{ $searchForm->field('q')->value() }}</b>:</p>
    @endif

    <div class="l-section">
        @foreach ($pages as $page)
            @include('cms::includes.page', $page)
        @endforeach
    </div>

    @if ($pages instanceof \Illuminate\Contracts\Pagination\Paginator)
    <div class="pagination">
        <ol class="list">
            {!! (new Wearenext\CMS\Support\Html\PaginationLinks($pages))->render() !!}
        </ol>
    </div>
    @endif
</div>
@stop
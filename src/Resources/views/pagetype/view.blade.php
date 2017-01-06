@extends('cms::layouts.default-header')

@section('title')
@lang('cms::pagetype.view.title')
@stop

@section('description')
@lang('cms::pagetype.view.description')
@stop

@section('content')
<div class="l-wrapper">
    <div class="header header--page">
        <h3 class="hN">@lang('cms::pagetype.view.header')</h3>
        <div class="header-actions">
            @can('cms.pagetype_create')
                <a class="btn btn--icon" href="{{ route('cms.pagetype.create') }}" role="button"><span class="icon icon--left fa fa-plus" title="Add" aria-hidden="true"></span> @lang('cms::pagetype.controls.create')</a>
            @endcan
            
            <form class="form form--search" id="form-search" action="{{ route('cms.pagetype.view') }}" method="get">
                <label class="u-visuallyhidden" for="search">@lang('cms::pagetype.fields.search.label')</label>
                <input class="input" type="text" id="search" name="{{ $searchForm->field('q')->name() }}" placeholder="@lang('cms::pagetype.fields.search.placeholder')" maxlength="20" value="{{ $searchForm->field('q')->value() }}">
                <button class="btn btn--transparent btn--icon" type="submit"><span class="icon icon--only fa fa-search" aria-hidden="true"></span></button>
            </form>
            
        </div>
    </div>

    @if (isset($errors))
        @include('cms::includes.alert', [ 'errors' => $errors ])
    @endif
    
    @if (!empty($searchForm->field('q')->value('')))
    <p>{{ $pageTypes->total() }} search {{ str_plural('result', $pageTypes->total()) }} for <b>{{ $searchForm->field('q')->value() }}</b>:</p>
    @endif

    <div class="l-section">
        @foreach ($pageTypes as $pageType)
            @include('cms::includes.pagetype', $pageType)
        @endforeach
    </div>

    @if ($pageTypes instanceof \Illuminate\Contracts\Pagination\Paginator)
    <div class="pagination">
        <ol class="list">
            {!! (new Wearenext\CMS\Support\Html\PaginationLinks($pageTypes))->render() !!}
        </ol>
    </div>
    @endif
</div>
@stop
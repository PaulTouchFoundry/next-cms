@extends('cms::layouts.default-header', ['userPage' => true,])

@section('title')
@lang('cms::user.index.title')
@stop

@section('content')
<div class="l-wrapper">
    <div class="header header--page">
        <h3 class="hN">@lang('cms::user.index.header')</h3>
        @can('cms.user_create')
        <div class="header-actions">
            <a class="btn btn--icon" href="{{ route('cms.user.create') }}"><span class="icon icon--left fa fa-plus" title="@lang('cms::user.controls.create')" aria-hidden="true"></span> @lang('cms::user.controls.create')</a>
        </div>
        @endcan
    </div>

    @include('cms::includes.alert', [ 'errors' => $errors ])

    <div class="l-section">
        @foreach($users as $user)
            @if ($user->trashed())
                <div class="card is-disabled">
                    <div class="card-inner">
                        <h3 class="card__title">{{ $user->name }} ({{ array_get($roles, "{$user->cms_role}") }})</h3>
                        <p class="card__synopsis">
                            {{ $user->email }}
                        </p>
                        <time class="card__time" datetime="{{ date('Y-m-d', strtotime($user->updated_at)) }}">@lang('cms::user.messages.last_updated', [ 'date' => date('j F Y, H:i', strtotime($user->updated_at)) ])</time>
                        @can('cms.user_edit')
                            <a class="btn btn--bordered btn--small" href="{{ route('cms.user.restore', [$user]) }}" role="button">Restore</a>
                        @endcan
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-inner">
                        @can('cms.user_edit')
                        <a class="card__link" href="{{ route('cms.user.edit', $user) }}">
                        @else
                        <a class="card__link" href="#">
                        @endcan
                            <h3 class="card__title">{{ $user->name }} ({{ array_get($roles, "{$user->cms_role}") }})</h3>
                            <p class="card__synopsis">
                                {{ $user->email }}
                            </p>
                            <time class="card__time" datetime="{{ date('Y-m-d', strtotime($user->updated_at)) }}">@lang('cms::user.messages.last_updated', [ 'date' => date('j F Y, H:i', strtotime($user->updated_at)) ])</time>
                        </a>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    @if ($users instanceof \Illuminate\Contracts\Pagination\Paginator)
    <div class="pagination">
        <ol class="list">
            {!! (new Wearenext\CMS\Support\Html\PaginationLinks($users))->render() !!}
        </ol>
    </div>
    @endif
</div>
@stop

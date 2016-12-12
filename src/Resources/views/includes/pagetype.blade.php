<div class="card is-published">
    <div class="card-inner">
        @can('cms.pagetype_edit')
        <a class="card__link" href="{{ $pageType->editUrl() }}">
        @else
        <a class="card__link">
        @endcan
            <h3 class="card__title">{{ $pageType->label }}</h3>
            <p class="card__synopsis">
                Defines the page type labeled <strong>{{ $pageType->label }}</strong>
            </p>
            <time class="card__time" datetime="{{ $pageType->updated_at->format('Y-m-d') }}">@lang('cms::messages.last_updated', [ 'date' => $pageType->updated_at->format('j F Y, H:i') ])</time>
        </a>
        <a class="btn btn--green btn--icon btn--small" href="{{ $pageType->pageUrl() }}">@lang('cms::controls.view')</a>
    </div>
</div>
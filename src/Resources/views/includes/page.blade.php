<div class="card{{ $page->published?' is-published':'' }}">
    <div class="card-inner">
        @can('cms.page_edit')
        <a class="card__link" href="{{ $page->editUrl() }}">
        @else
        <a class="card__link" href="#">
        @endcan
            <h3 class="card__title">{{ $page->name }}</h3>
            <p class="card__synopsis">{{ $page->resolveSummary() }}</p>
            <time class="card__time" datetime="{{ $page->updated_at->format('Y-m-d') }}">@lang('cms::messages.last_updated', [ 'date' => $page->updated_at->format('j F Y, H:i') ])</time>
            <div class="card__info" style="display:none">
                <ul class="list list--inline">
                    <li>@lang('cms::messages.stats.views', [ 'count' => '0' ])</li>
                    <li>@lang('cms::messages.stats.clicks', [ 'count' => '0' ])</li>
                    <li>@lang('cms::messages.stats.quotes', [ 'count' => '0' ])</li>
                    <li>@lang('cms::messages.stats.call_backs', [ 'count' => '0' ])</li>
                </ul>
            </div>
        </a>
        
        @if ($page->published)
            @can('cms.page_preview')
            <a class="btn btn--green btn--icon btn--small" href="{{ $page->previewUrl() }}" target="_blank" role="button">@lang('cms::controls.view')<span class="icon fa fa-external-link" title="External Link" aria-hidden="true"></span></a>
            @endcan
            @can('cms.page_unpublish')
            <div class="card__info">
                <ul class="list list--inline">
                    <li><a href="{{ $page->unpublishUrl() }}">@lang('cms::controls.unpublish')</a></li>
                </ul>
            </div>
            @endcan
        @else
            @can('cms.page_publish')
            <a class="btn btn--bordered btn--small" href="{{ $page->publishUrl() }}" role="button">@lang('cms::controls.publish')</a>
            @endcan
            @can('cms.page_preview')
            <div class="card__info">
                <ul class="list list--inline">
                    <li><a href="{{ $page->previewUrl() }}" target="_blank">@lang('cms::controls.preview')</a></li>
                </ul>
            </div>
            @endcan
        @endif

        @if (request()->get('show-links', false))
        <small>
            <br>
            @if ($page->slug)
                <b>{!! Html::link($page->previewUrl(), null, ['target' => '_blank']) !!}</b><br>
            @else
                <b>This {{ $page->type->label }} doesn't have a slug.</b><br>
            @endif
        </small>
        @endif
    </div>
</div>

<div class="card card--alt">
    <div class="card-inner">
        <a class="card__link" href="{{ route('cms.block.edit_block', ['cmsBlock' => $block,]) }}">
            <input type="hidden" name="blocks[]" value="{{ $block->id }}" />
            <div class="card__type">Text Block</div>
            <h3 class="card__title">{{ $block->headline }}</h3>
            <p class="card__synopsis">{{ str_limit(strip_tags($block->content)) }}</p>
            <time class="card__time" datetime="{{ date('Y-m-d', strtotime($block->updated_at)) }}">Last Updated: {{ date('j F Y, H:i', strtotime($block->updated_at)) }}</time>
        </a>
        <div class="card__icons">
            <a class="js-move-block-up"><span class="icon fa fa-arrow-up" title="Move Up" aria-hidden="true"></span></a>
            <a class="js-move-block-down"><span class="icon fa fa-arrow-down" title="Move Down" aria-hidden="true"></span></a>
        </div>

        @foreach ($block->callouts as $callout)
            <div class="card card--attachment">
                <a class="card__link" href="{{ route('cms.callout.edit', ['cmsType' => $type->slug, 'cmsPage' => $page, 'cmsCallout' => $callout,]) }}">
                    <div class="card-inner">
                        <div class="card__type">Call Out</div>
                        @if (!is_null($callout->large_heading))
                            <h3 class="card__title">{{ $callout->large_heading}}</h3>
                        @elseif (!is_null($callout->small_heading))
                            <h3 class="card__title">{{ $callout->small_heading }}</h3>
                        @elseif (!is_null($callout->button))
                            <h3 class="card__title">Button: {{ $callout->button }}</h3>
                        @elseif (!is_null($callout->text))
                            <h3 class="card__title">{{ str_limit($callout->text, 35) }}</h3>
                        @elseif (!is_null($callout->quote))
                            <h3 class="card__title">Quote: {{ $callout->quote }}</h3>
                        @endif
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

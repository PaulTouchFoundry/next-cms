<div class="card card--alt">
    <div class="card-inner">
        <a class="card__link" href="{{ route('cms.block.edit_block', ['cmsBlock' => $block,]) }}">
            <input type="hidden" name="blocks[]" value="{{ $block->id }}" />
            <div class="card__type">Icon List</div>
            <h3 class="card__title">{{ $block->headline }}</h3>
            @if (count($block->icon_list) > 0)
                <ul class="list list--inline card__list">
                    @foreach ($block->icon_list as $icon)
                        <li>
                            <span class="{{ config("cms.icons.prefix.". config('cms.icon_set')).array_get($icon, 'class') }}" aria-hidden="true"></span>
                            {{ array_get($icon, 'text') }}
                        </li>
                    @endforeach
                </ul>
            @endif
            <time class="card__time" datetime="{{ date('Y-m-d', strtotime($block->updated_at)) }}">Last Updated: {{ date('j F Y, H:i', strtotime($block->updated_at)) }}</time>
        </a>
        <div class="card__icons">
            <a class="js-move-block-up"><span class="icon fa fa-arrow-up" title="Move Up" aria-hidden="true"></span></a>
            <a class="js-move-block-down"><span class="icon fa fa-arrow-down" title="Move Down" aria-hidden="true"></span></a>
        </div>
    </div>
</div>

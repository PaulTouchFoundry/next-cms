<div class="card card--alt">
    <div class="card-inner">
        <a class="card__link" href="{{ route('cms.block.edit_block', ['cmsBlock' => $block,]) }}">
            <input type="hidden" name="blocks[]" value="{{ $block->id }}" />
            <img class="card__img" src="{{ $block->media->first()->getThumb() }}" width="300" height="169" alt="" />
            <div class="card__type">Image Block</div>
            @if (!empty("{$block->title}"))
                <h3 class="card__title">"<i>{{$block->title}}</i>"</h3>
            @else
                <h3 class="card__title">{!! $block->media->first()->filename !!}</h3>
            @endif
            <time class="card__time" datetime="{{ date('Y-m-d', strtotime($block->updated_at)) }}">Last Updated: {{ date('j F Y, H:i', strtotime($block->updated_at)) }}</time>
        </a>
        <div class="card__icons">
            <a class="js-move-block-up"><span class="icon fa fa-arrow-up" title="Move Up" aria-hidden="true"></span></a>
            <a class="js-move-block-down"><span class="icon fa fa-arrow-down" title="Move Down" aria-hidden="true"></span></a>
        </div>
    </div>
</div>

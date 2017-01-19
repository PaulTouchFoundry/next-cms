<div class="card card--alt">
    <div class="card-inner">
        <a class="card__link" href="{{ route('cms.block.edit_block', ['cmsBlock' => $block,]) }}">
            <input type="hidden" name="blocks[]" value="{{ $block->id }}" />
            <div class="card__type">Table Block</div>
            <h3 class="card__title">{{ $block->headline }}</h3>
            <p class="card__synopsis">
                <?php
                $table = json_decode($block->content, true);
                if (!is_array($table)) {
                    $table = [];
                }
                ?>
                <table class="table">
                @foreach (array_splice($table, 0, 3) as $tr)
                <tr>
                    @foreach ($tr as $td)
                    <td>{{ $td }}</td>
                    @endforeach
                </tr>
                @endforeach
                </table>
            </p>
            <time class="card__time" datetime="{{ date('Y-m-d', strtotime($block->updated_at)) }}">Last Updated: {{ date('j F Y, H:i', strtotime($block->updated_at)) }}</time>
        </a>
        <div class="card__icons">
            <a class="js-move-block-up"><span class="icon fa fa-arrow-up" title="Move Up" aria-hidden="true"></span></a>
            <a class="js-move-block-down"><span class="icon fa fa-arrow-down" title="Move Down" aria-hidden="true"></span></a>
        </div>
    </div>
</div>

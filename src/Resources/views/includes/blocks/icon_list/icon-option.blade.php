<div class="icons-list__item js-icon-list-entry" id="{{ $id }}">
    <div class="accordion js-accordion" role="tablist">
        <div class="accordion-item" role="tab" aria-selected="true" aria-hidden="false">
            <div class="accordion-item__title" id="accordion-tab-{{ $id }}" aria-controls="accordion-panel-{{ $id }}" role="tab">
                <a class="accordion-item__link" href="#" data-icon-up="fa-caret-up" data-icon-down="fa-caret-down">
                    @if (array_get($item, 'class'))
                        <span class="{{ config("cms.icons.prefix.". config('cms.icon_set')).array_get($item, 'class') }} js-icon-list-select-preview" aria-hidden="true"></span>
                    @else
                        <span class="js-icon-list-select-preview" aria-hidden="true"></span>
                        <span class="js-icon-list-select-placeholder">
                            @lang('cms::block.icon_list.fields.icon-option.choose_icon')
                        </span>
                    @endif
                    <span class="icon fa fa-caret-down" aria-hidden="true"></span>
                </a>
            </div>
            <div class="accordion-item__contents" id="accordion-panel-{{ $id }}" aria-labelledby="accordion-tab-{{ $id }}" role="tabpanel">
                @foreach (config("cms.icons.". config('cms.icon_set')) as $i => $icon)
                    <label class="label label--inline js-icon-list-select-radio" for="radio-{{ $i }}-{{ $id }}">
                        <?php
                            $prefix = config("cms.icons.prefix.". config('cms.icon_set'));
                        ?>
                        {!! CMSForm::radio("icon_list[{$id}][class]", $icon, (array_get($item, 'class') == $icon), [ 'id' => 'radio-'.$i .'-'.$id ]) !!}
                        <span class="{{ $prefix.$icon }}" aria-hidden="true"></span>
                    </label>
                @endforeach
            </div>
        </div>
    </div>
    <label class="label" for="list-item-name">
        <span class="u-visuallyhidden">@lang('cms::block.icon_list.fields.icon-option.list_item')</span>
        {!! CMSForm::text("icon_list[{$id}][text]", $item['text'], [ 'placeholder' => trans('cms::block.icon_list.fields.icon-option.placeholder'), 'id' => 'list-item-name' ]) !!}
    </label>
    <a class="icons-list__remove js-icons-list-item-remove" data-icons-list-item-id="{{ $id }}" href="#" style="{{ ($removable?'':'display:none') }}">
        <span class="icon fa fa-close" title="@lang('cms::block.icon_list.fields.icon-option.delete')" aria-hidden="true"></span>@lang('cms::block.icon_list.fields.icon-option.delete')
    </a>
</div>

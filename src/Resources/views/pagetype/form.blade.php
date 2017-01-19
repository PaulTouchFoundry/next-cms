<div class="l-section">
    <div class="l-content">
        <label class="{{ $form->field('label')->labelClass() }}" for="label">
            @lang('cms::pagetype.fields.label.label')
            <input class="input" type="text" id="label" name="{{ $form->field('label')->name() }}" maxlength="255" placeholder="@lang('cms::pagetype.fields.label.placeholder')" value="{{ $form->field('label')->value() }}" />
            {!! $form->field('label')->helpHtml() !!}
        </label>
        <label class="{{ $form->field('slug')->labelClass() }}" for="slug">
            @lang('cms::pagetype.fields.slug.label')
            <input class="input" type="text" id="slug" name="{{ $form->field('slug')->name() }}" maxlength="255" placeholder="@lang('cms::pagetype.fields.slug.placeholder')" value="{{ $form->field('slug')->value() }}" />
            {!! $form->field('slug')->helpHtml() !!}
        </label>
    </div>
</div>
<div class="l-section">
    <div class="l-content">
        <h4>@lang('cms::pagetype.fields.fields.label')</h4>
        @foreach ($form->field('fields')->value([]) as $key => $value)
        <div class="row">
            <div class="col col-1-2">
                <label class="{{ $form->field("fields.{$key}.field")->labelClass() }}" for="field-{{ $key }}">
                    <span class="u-visuallyhidden">@lang('cms::pagetype.fields.fields.label')</span>
                    <input class="input" type="text" id="field-{{ $key }}" name="fields[{{ $key }}][field]" maxlength="50" placeholder="@lang('cms::pagetype.fields.fields.placeholder')" value="{{ $value['field'] }}" />
                    {!! $form->field("fields.{$key}.field")->helpHtml() !!}
                </label>
            </div>
            <div class="col col-1-2">
                <label class="{{ $form->field("fields.{$key}.value")->labelClass() }}" for="value-{{ $key }}">
                    <span class="u-visuallyhidden">@lang('cms::pagetype.fields.value.label')</span>
                    <input class="input" type="text" id="value-{{ $key }}" name="fields[{{ $key }}][value]" maxlength="50" placeholder="@lang('cms::pagetype.fields.value.placeholder')" value="{{ $value['value'] }}" />
                    {!! $form->field("fields.{$key}.value")->helpHtml() !!}
                </label>
            </div>
        </div>
        @endforeach
        <div class="row js-fields-entry" data-clonekey="{{ count($form->field('fields')->value([])) }}">
            <div class="col col-1-2">
                <label class="label" for="field-new-id">
                    <span class="u-visuallyhidden">@lang('cms::pagetype.fields.fields.label')</span>
                    <input class="input" type="text" id="field-new-id" name="fields[id][field]" maxlength="50" placeholder="@lang('cms::pagetype.fields.fields.placeholder')" value="" />
                </label>
            </div>
            <div class="col col-1-2">
                <label class="label" for="value-new-id">
                    <span class="u-visuallyhidden">@lang('cms::pagetype.fields.value.label')</span>
                    <input class="input" type="text" id="value-new-id" name="fields[id][value]" maxlength="50" placeholder="@lang('cms::pagetype.fields.value.placeholder')" value="" />
                </label>
            </div>
        </div>

        <button class="btn btn--bordered btn--icon btn--small js-clone-entry-add" type="button" data-clone="js-fields-entry"><span class="icon icon--left fa fa-plus" title="Add" aria-hidden="true"></span>Label</button>
    </div>
</div>
<div class="l-section">
    <div class="l-content">
        <fieldset class="fieldset fieldset--bordered">
            <legend class="legend">@lang('cms::pagetype.fields.features.label')</legend>
            @foreach (array_keys(config('cms.features', [])) as $key => $feature)
            <label class="label label--checkbox label--inline" for="feature-{{$key}}">
                <input type="checkbox" class="js-feature-checkbox" id="feature-{{$key}}" name="features[{{ $feature }}]" value="1" data-feature="{{ $feature }}"{{ $form->field('features')->checked($feature) }} /> @lang("cms::pagetype.features.{$feature}")
            </label>
            @endforeach
            <input type="hidden" name="features[id]" value="" />
            <input type="hidden" name="blocks[id]" value="" />
        </fieldset>

        <br />

        <fieldset class="fieldset fieldset--bordered options_page_hero">
            <legend class="legend">@lang('cms::pagetype.fields.page_hero.label')</legend>
            <label class="label label--checkbox label--inline" for="page_hero_buttons">
                <input type="radio" id="page_hero_buttons" name="_features_page_buttons" value="1" data-applies-to="page_hero"{{ $form->field('features.page_hero')->checked('1') }} /> @lang('cms::pagetype.fields.page_hero.hero_buttons')
            </label>
            <label class="label label--checkbox label--inline" for="page_hero_no_buttons">
                <input type="radio" id="page_hero_no_buttons" name="_features_page_buttons" value="no_buttons" data-applies-to="page_hero"{{ $form->field('features.page_hero')->checked('no_buttons') }} /> @lang('cms::pagetype.fields.page_hero.no_buttons')
            </label>
        </fieldset>

        <br />

        <fieldset class="fieldset fieldset--bordered options_page_relationship">
            <legend class="legend">@lang('cms::pagetype.fields.page_relationship.label')</legend>
            @foreach ($form->field('relations')->value([]) as $key => $value)
            <div class="row">
                <div class="col col-1-2">
                    <label class="{{ $form->field("relations.{$key}.label")->labelClass() }}" for="relationship-name-{{ $key }}">
                        <span class="u-visuallyhidden">@lang('cms::pagetype.fields.page_relationship_name.label')</span>
                        <input class="input" type="text" id="relationship-name-{{ $key }}" name="relations[{{ $key }}][label]" maxlength="50" placeholder="@lang('cms::pagetype.fields.page_relationship_name.placeholder')" value="{{ $form->field("relations.{$key}.label")->value() }}" />
                        {!! $form->field('relationship.name')->helpHtml() !!}
                    </label>
                </div>
                <div class="col col-1-2">
                    <label class="label" for="relationship-page-{{ $key }}">
                        <span class="u-visuallyhidden">@lang('cms::pagetype.fields.page_relationship_related.label')</span>
                        <select id="relationship-page-{{ $key }}" name="relations[{{ $key }}][pagetype_id]" class="input input--select">
                            @foreach (Wearenext\CMS\Models\PageType::all() as $entry)
                            <option value="{{ $entry->id }}"{!! $form->field("relations.{$key}.pagetype_id")->selected($entry->id) !!}>{{ $entry->label }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
            </div>
            @endforeach
            <div class="row js-relation-entry" data-clonekey="{{ count($form->field('relations')->value([])) }}">
                <div class="col col-1-2">
                    <label class="{{ $form->field('relations.0.label')->labelClass() }}" for="relationship-name-id">
                        <span class="u-visuallyhidden">@lang('cms::pagetype.fields.page_relationship_name.label')</span>
                        <input class="input" type="text" id="relationship-name-id" name="relations[id][label]" maxlength="50" placeholder="@lang('cms::pagetype.fields.page_relationship_name.placeholder')" value="" />
                        {!! $form->field('relationship.name')->helpHtml() !!}
                    </label>
                </div>
                <div class="col col-1-2">
                    <label class="label" for="relationship-page-id">
                        <span class="u-visuallyhidden">@lang('cms::pagetype.fields.page_relationship_related.label')</span>
                        <select id="relationship-page-id" name="relations[id][pagetype_id]" class="input input--select">
                            @foreach (Wearenext\CMS\Models\PageType::all() as $entry)
                            <option value="{{ $entry->id }}">{{ $entry->label }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
            </div>
            <button class="btn btn--bordered btn--icon btn--small js-clone-entry-add" type="button" data-clone="js-relation-entry"><span class="icon icon--left fa fa-plus" title="Add" aria-hidden="true"></span>Relation</button>
        </fieldset>
    </div>
</div>
<div class="l-section">
    <div class="l-content">
        <label class="{{ $form->field('block_quota')->labelClass() }}" for="label">
            @lang('cms::pagetype.fields.block_quota.label')
            <input class="input" type="number" id="label" name="{{ $form->field('block_quota')->name() }}" placeholder="@lang('cms::pagetype.fields.block_quota.placeholder')" value="{{ $form->field('block_quota')->value() }}" />
            {!! $form->field('block_quota')->helpHtml() !!}
        </label>
        <fieldset class="fieldset fieldset--bordered">
            <legend class="legend">@lang('cms::pagetype.fields.blocktypes.label')</legend>
            <label class="label label--checkbox label--inline" for="block-callout">
                <input type="checkbox" id="block-callout" name="blocks[call_out]" value="1"{!! $form->field('blocks.call_out')->checked() !!}/> @lang('cms::pagetype.fields.blocktypes.call_out')
            </label>
            <label class="label label--checkbox label--inline" for="block-icon-list">
                <input type="checkbox" id="block-icon-list" name="blocks[icon_list]" value="1"{!! $form->field('blocks.icon_list')->checked() !!}/> @lang('cms::pagetype.fields.blocktypes.icon_list')
            </label>
            <label class="label label--checkbox label--inline" for="block-embed">
                <input type="checkbox" id="block-embed" name="blocks[embed]" value="1"{!! $form->field('blocks.embed')->checked() !!}/> @lang('cms::pagetype.fields.blocktypes.embed')
            </label>
            <label class="label label--checkbox label--inline" for="block-media-image">
                <input type="checkbox" id="block-media-image" name="blocks[media_image]" value="1"{!! $form->field('blocks.media_image')->checked() !!}/> @lang('cms::pagetype.fields.blocktypes.media_image')
            </label>
            <label class="label label--checkbox label--inline" for="block-text">
                <input type="checkbox" id="block-text" name="blocks[text]" value="1"{!! $form->field('blocks.text')->checked() !!}/> @lang('cms::pagetype.fields.blocktypes.text')
            </label>
            <label class="label label--checkbox label--inline" for="block-featured">
                <input type="checkbox" id="block-featured" name="blocks[featured]" value="1"{!! $form->field('blocks.featured')->checked() !!}/> @lang('cms::pagetype.fields.blocktypes.featured')
            </label>
            <label class="label label--checkbox label--inline" for="callout">
                <input type="checkbox" id="callout" name="callout" value="1"{!! $form->field('callout')->checked(true) !!}/> @lang('cms::pagetype.fields.blocktypes.callout')
            </label>
            <label class="label label--checkbox label--inline" for="block-table">
                <input type="checkbox" id="block-table" name="blocks[table]" value="1"{!! $form->field('blocks.table')->checked() !!}/> @lang('cms::pagetype.fields.blocktypes.table')
            </label>
        </fieldset>
    </div>
</div>
<div class="l-section">
    <div class="l-content">
        <label class="{{ $form->field('name')->labelClass() }}" for="name">
            {{ $type->field('name.label') }}
            <input class="input" type="text" id="name" name="{{ $form->field('name')->name() }}" maxlength="255" placeholder="{{ $type->field('name.placeholder') }}" value="{{ $form->field("name")->value() }}" />
            {!! $form->field('name')->helpHtml() !!}
        </label>
<!--        <label class="label" for="select-product">
            Select Product
            <select id="select-1" name="select-product" class="input input--select">
                <option value="1">Product Name One</option>
                <option value="2">Product Name Two</option>
                <option value="3">Product Name Three</option>
            </select>
        </label>-->
<!--        <label class="label" for="tracking-id">
            Tracking ID
            <input class="input" type="text" id="tracking-id" name="tracking-id" maxlength="10" />
        </label>-->

        @if ($type->hasFeature('page_hero'))
            <?php
            $hero = null;
            $media = null;
            $buttons = [];
            if (isset($page)) {
                $hero = $page->pageHero;
            }
            // Resolve buttons
            if (is_array(data_get($hero, 'hero_buttons'))) {
                $buttons = data_get($hero, 'hero_buttons');
            }

            // Resolve media
            $mediaID = data_get($hero, 'hero_media_id');
            if (!is_null($mediaID)) {
                $media = Wearenext\CMS\Models\Media::find($mediaID);
            }
            ?>
            @if ($form->field('features.page_hero')->value() == 'hero_buttons')
            <label class="label">{{ $type->field('hero_buttons.label') }}</label>

            <label class="label label--checkbox label--inline" for="checkbox-a">
                <input type="checkbox" id="checkbox-a" name="hero_buttons[]" value="callme"{!! (in_array('callme', $buttons)?' selected="selected"':'') !!} /> {{ $type->field('hero_buttons.callme') }}
            </label>

            <label class="label label--checkbox label--inline" for="checkbox-b">
                <input type="checkbox" id="checkbox-b" name="hero_buttons[]" value="getaquote"{!! (in_array('getaquote', $buttons)?' selected="selected"':'') !!} /> {{ $type->field('hero_buttons.getaquote') }}
            </label>

            <label class="label label--checkbox label--inline" for="checkbox-c">
                <input type="checkbox" id="checkbox-c" name="hero_buttons[]" value="getinsured"{!! (in_array('getinsured', $buttons)?' selected="selected"':'') !!} /> {{ $type->field('hero_buttons.getinsured') }}
            </label>
            @else
            <label class="{{ $form->field("pageHero.hero_title")->labelClass() }}" for="hero_title">
                {{ $type->field('hero_title.label') }}
                <input class="input" type="text" id="hero_title" name="hero_title" maxlength="255" placeholder="{{ $type->field('hero_title.placeholder') }}" value="{{ data_get($hero, 'hero_title') }}" />
            </label>
            @endif

            {!! CMSForm::input('hidden', 'hero_media_id', $mediaID, [ 'class' => 'js-media-selected-input' ]) !!}
            <div class="image js-media-select-preview{{ (is_null($media)?' u-hidden':'') }}">
                <img src="{{ (!is_null($media)?$media->getURL():'') }}" width="2000" height="618" alt="" />
                <a class="image__remove js-media-deselect" href="#"><span class="icon fa fa-minus" title="Remove" aria-hidden="true"></span></a>
            </div>
            <div class="btn-group btn-group--left">
                <a class="btn btn--small btn--bordered" href="#modal" data-toggle="modal" data-target="#modal" role="button">@lang('cms::page.fields.hero_image.select')</a>
                <a class="btn btn--small" role="button" href="{{ route('cms.media.edit', ['tag' => 'hero',]) }}?from=page&pagetype_id={{ $type->id }}{{ (isset($page)?'&page_id='.$page->id:'') }}">@lang('cms::page.fields.hero_image.manage')</a>
            </div>
        @endif
    </div>
</div>

@unless (!count($relations))
<div class="l-section">
    <div class="l-content">
        @foreach ($relations as $id => $value)
        <fieldset class="fieldset fieldset--bordered">
            <legend class="legend">{{ $value['label'] }}</legend>

            @foreach ($value['pages'] as $pageID => $p)
            <label class="label label--checkbox label--inline" for="related-page-{{ $pageID }}">
                <input type="checkbox" id="related-page-{{ $pageID }}" name="related_page[]" @if ($p['selected']) checked="checked"@endif value="{{ json_encode([ 'related_page_id' => $pageID, 'related_pagetype_id' => $value['pagetype_id'], 'relation_name' => $value['label'], 'relation_id' => $value['relation_id'] ]) }}" /> {{ $p['name'] }}
            </label>
            @endforeach
        </fieldset>

        <br>
        @endforeach
    </div>
</div>
@endunless

@if ($type->hasFeature('page_key_features'))
<div class="l-section">
    <div class="l-content">
        <h4>{{ $type->field('page_key_features.label') }}</h4>
        <?php
        $features = null;
        if (isset($page)) {
            $features = $page->pageKeyFeatures;
            if (!is_null($features)) {
                $features = $features->key_features;
            }
        }
        
        if (!is_array($features)) {
            $features = [];
        }
        ?>
        @foreach ($features as $key => $value)
        <label class="{{ $form->field("pageKeyFeatures.key_features.{$key}")->labelClass() }}" for="feature-{{ $key }}">
            <span class="u-visuallyhidden">{{ $type->field('page_key_features.label') }}</span>
            <input class="input" type="text" id="feature-{{ $key }}" name="key_features[]" maxlength="50" placeholder="{{ $type->field('page_key_features.placeholder') }}" value="{{ $value }}" />
            {!! $form->field("pageKeyFeatures.key_features.{$key}")->helpHtml() !!}
        </label>
        @endforeach
        <label class="label js-feature-entry" for="feature-id" data-clonekey="{{ count($features) }}">
            <span class="u-visuallyhidden">{{ $type->field('page_key_features.label') }}</span>
            <input class="input" type="text" id="feature-id" name="key_features[]" maxlength="50" placeholder="{{ $type->field('page_key_features.placeholder') }}" />
        </label>

        <button class="btn btn--bordered btn--icon btn--small js-clone-entry-add" type="button" data-clone="js-feature-entry"><span class="icon icon--left fa fa-plus" title="Add" aria-hidden="true"></span>Feature</button>
    </div>
</div>
@endif

@if ($type->hasFeature('page_products'))
<?php
$product = null;
if (isset($page)) {
    $product = $page->pageProduct;
}
?>
<div class="l-section">
    <div class="l-content">
        <h4>Premium & Cover Example</h4>
        <div class="row">
            <div class="col col-1-4">
                {!! CMSForm::wrapLabel('premium', $type->field('product_premium.label')) !!}
                {!! CMSForm::text('premium', data_get($product, 'premium'), [ 'placeholder' => $type->field('product_premium.placeholder'), 'maxlength' => '100' ]) !!}
            </div>
            <div class="col col-1-2">
                {!! CMSForm::wrapLabel('description', $type->field('product_description.label')) !!}
                {!! CMSForm::text('description', data_get($product, 'description'), [ 'placeholder' => $type->field('product_description.placeholder'), 'maxlength' => '100' ]) !!}
            </div>
            <div class="col col-1-4">
                {!! CMSForm::wrapLabel('cover', $type->field('product_cover.label')) !!}
                {!! CMSForm::text('cover', data_get($product, 'cover'), [ 'placeholder' => $type->field('product_cover.label'), 'maxlength' => '100' ]) !!}
            </div>
        </div>

        {!! CMSForm::wrapLabel('disclaimer', $type->field('product_disclaimer.label')) !!}
        {!! CMSForm::text('disclaimer', data_get($product, 'disclaimer'), [ 'placeholder' => $type->field('product_disclaimer.placeholder'), 'maxlength' => '100' ]) !!}
    </div>
</div>
@endif

<div class="l-section">
    <div class="l-content">
        <h4>{{ $type->field('meta.label') }}</h4>
        <label class="{{ $form->field('meta_title')->labelClass() }}" for="meta_title">
            {{ $type->field('meta_title.label') }}
            <input class="input" type="text" id="meta_title" name="{{ $form->field('meta_title')->name() }}" maxlength="255" placeholder="{{ $type->field('meta_title.placeholder') }}" value="{{ $form->field('meta_title')->value() }}" />
            {!! $form->field('meta_title')->helpHtml() !!}
        </label>

        <label class="{{ $form->field('meta_description')->labelClass() }}" for="meta_description">
            {{ $type->field('meta_description.label') }}
            <input class="input" type="text" id="meta_description" name="{{ $form->field('meta_description')->name() }}" maxlength="255" placeholder="{{ $type->field('meta_description.placeholder') }}" value="{{ $form->field('meta_description')->value() }}" />
            {!! $form->field('meta_description')->helpHtml() !!}
        </label>
        <label class="{{ $form->field('meta_custom_date')->labelClass() }}" for="meta_custom_date">
            {{ $type->field('meta_custom_date.label') }}
            <input type="text" id="custom_date" name="custom_date" placeholder="Click to set a blog date" class="input" value="{{ $form->field('custom_date')->value() }}">
        </label>
    </div>
</div>

<?php
$urls = [];
if (isset($page)) {
    $urls = $page->urls;
}
?>
<div class="l-section">
    <div class="l-content">
        <h4>Paths</h4>

        <div class="js-paths-list">
            @foreach ($urls as $index => $path)
                <label class="label" for="path-{{ $path->id }}">
                    <span class="u-visuallyhidden">Path</span>
                    <input class="input" type="text" id="path-{{ $index }}" name="paths[{{ $index }}]" maxlength="140" value="{{ $path->url }}" />
                </label>
            @endforeach
        </div>

        <a class="btn btn--bordered btn--icon btn--small js-adds-path" role="button">
            <span class="icon icon--left fa fa-plus" title="Add" aria-hidden="true"></span>Path
        </a>
    </div>
</div>
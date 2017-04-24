<?php

return [
    'group' => [
        'prefix' => 'admin',
    ],
    'brand' => [
        'color' => '#737373',
        'title' => 'Wearenext-CMS',
    ],
    'features' => [
        'page_hero' => Wearenext\CMS\Models\Features\Hero::class,
        'page_products' => Wearenext\CMS\Models\Features\Product::class,
        'page_key_features' => Wearenext\CMS\Models\Features\KeyFeatures::class,
        'featured_article' => Wearenext\CMS\Models\Page::class.'->featured_article',
    ],
    'auth' => [
        'middleware' => 'auth',
    ],
    /**
     * @todo CMS icon set issue #1
     */
    'icon_set' => 'default',
    'icons' => [
        'prefix' => [
            'default' => '',
        ],
        'default' => [],
    ],
    
    'cloudinary' => [
        'store' => null,
        'thumb_store' => null,
        'resource' => null,
        'resource_thumb' => null,
    ],
    
    'docs' => [
        'path' => null,
        'resource' => null,
    ],
];

<?php

return [
    'view' => [
        'header' => ':type',
        'title' => ':type',
    ],
    'create' => [
        'header' => 'New :type',
        'title' => 'Create :type',
    ],
    'edit' => [
        'header' => 'Edit :type:',
        'title' => 'Edit :type',
    ],
    'fields' => [
        'search' => [
            'placeholder' => 'Search',
        ],
        'name' => [
            'label' => 'Page Name',
            'placeholder' => 'e.g. Terms and Conditions',
        ],
        'hero_title' => [
            'label' => 'Hero Title',
            'placeholder' => '',
        ],
        'hero_image' => [
            'label' => 'Hero Image',
            'select' => 'Choose Image',
            'manage' => 'Upload Image',
        ],
        'meta' => [
            'label' => 'Meta',
        ],
        'meta_title' => [
            'label' => 'Title',
            'placeholder' => '',
        ],
        'meta_description' => [
            'label' => 'Description',
            'placeholder' => '',
        ],
        'meta_custom_date' => [
            'label' => 'Custom Date',
            'placeholder' => '',
        ],
        'product_premium' => [
            'label' => 'Premium',
            'placeholder' => 'e.g. 150',
        ],
        'product_description' => [
            'label' => 'Description',
            'placeholder' => '',
        ],
        'product_cover' => [
            'label' => 'Cover',
            'placeholder' => '',
        ],
        'product_disclaimer' => [
            'label' => 'Disclaimer',
            'placeholder' => '',
        ],
        'page_key_features' => [
            'label' => 'Key Features',
            'placeholder' => '',
        ],
    ],
    'messages' => [
        'published' => ':name has been published. <a class="alert__link" href=":preview" target="_blank">Check it out</a>.',
        'unpublished' => ':name has been unpublished. <a class="alert__link" href=":preview">Undo this action</a>.',
        'deleted_undo' => 'You have deleted :name. <a href=":url" class="alert__link">Undo?</a>',
        'deleted' => 'You have deleted :name.',
        'saved_undo' => 'You have successfully created :name. <a href=":url" class="alert__link">Undo?</a>',
        'saved' => 'You have successfully created :name.',
        'updated_undo' => 'You have successfully updated :name. <a href=":url" class="alert__link">Undo?</a>',
        'updated' => 'You have successfully updated :name.',
    ],
    'controls' => [
        'create' => 'New :type',
        'next' => 'Next',
        'update' => 'Update :type',
        'delete' => 'Delete :type',
    ],
];

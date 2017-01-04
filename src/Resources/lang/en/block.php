<?php

return [
    'index' => [
        'header' => 'Edit :type:',
        'title' => 'Edit :type',
    ],
    'create' => [
        'header' => 'Create :type',
        'title' => 'Create :type',
    ],
    'edit' => [
        'header' => 'Edit :type:',
        'title' => 'Edit :type',
    ],
    'controls' => [
        'save' => 'Update',
        'preview' => 'Preview :type',
    ],
    'messages' => [
        'text_block_saved_undo' => 'You have successfully created a text block. <a href=":url" class="alert__link">Undo?</a>',
        'text_block_saved' => 'You have successfully created a text block.',
        'text_block_updated_undo' => 'You have successfully updated a text block. <a href=":url" class="alert__link">Undo?</a>',
        'text_block_updated' => 'You have successfully updated a text block.',
        'icon_list_block_saved_undo' => 'You have successfully created a icon list block. <a href=":url" class="alert__link">Undo?</a>',
        'icon_list_block_saved' => 'You have successfully created a icon list block.',
        'icon_list_block_updated_undo' => 'You have successfully updated a icon list block. <a href=":url" class="alert__link">Undo?</a>',
        'icon_list_block_updated' => 'You have successfully updated a icon list block.',
        'media_block_saved_undo' => 'You have created a media block. <a href=":url" class="alert__link">Undo?</a>',
        'media_block_saved' => 'You have created a media block.',
        'media_block_updated_undo' => 'You have updated the media block. <a href=":url" class="alert__link">Undo?</a>',
        'media_block_updated' => 'You have updated the media block.',
        'embed_block_saved_undo' => 'You have created a HTML block. <a href=":url" class="alert__link">Undo?</a>',
        'embed_block_saved' => 'You have created a HTML block.',
        'embed_block_updated_undo' => 'You have updated the HTML block. <a href=":url" class="alert__link">Undo?</a>',
        'embed_block_updated' => 'You have updated the HTML block.',
        'deleted_undo' => 'You have deleted :name <a href=":url" class="alert__link">Undo?</a>',
        'deleted' => 'You have deleted :name',
        'block_quota' => 'There are too many blocks',
    ],
    'text' => [
        'label' => 'Text Block',
        'legend' => 'Text Block',
        'fields' => [
            'headline' => [
                'label' => 'Headline',
                'placeholder' => '',
            ],
            'content' => [
                'placeholder' => '',
            ],
            'quicklink' => [
                'label' => 'Include in content navigation?',
            ],
            'title' => [
                'label' => 'Navigation Title',
                'placeholder' => 'Features',
            ],
        ],
        'controls' => [
            'create' => 'Create Text Block',
            'update' => 'Update Text Block',
            'delete' => 'Delete Text Block',
        ],
    ],
    'icon_list' => [
        'label' => 'Icon List',
        'legend' => 'Icon List',
        'fields' => [
            'headline' => [
                'label' => 'Headline',
                'placeholder' => 'e.g. Key features',
            ],
            'icon-option' => [
                'label' => 'First Icon',
                'placeholder' => '',
                'choose_icon' => 'Choose an icon',
                'list_item' => 'List Item Name',
                'delete' => 'Delete Icon',
            ],
            'quicklink' => [
                'label' => 'Include in content navigation?',
            ],
            'title' => [
                'label' => 'Navigation Title',
                'placeholder' => 'Features',
            ],
        ],
        'controls' => [
            'create' => 'Create Icon List',
            'update' => 'Update Icon List',
            'delete' => 'Delete Icon List',
        ],
    ],
    'media_image' => [
        'label' => 'Image Block',
        'legend' => 'Image Block',
        'controls' => [
            'create' => 'Create Image Block',
            'update' => 'Update Image Block',
            'delete' => 'Delete Image Block',
        ],
    ],
    'embed' => [
        'label' => 'HTML Block',
        'legend' => 'HTML Block',
        'fields' => [
            'content' => [
                'label' => 'HTML',
                'placeholder' => '',
            ],
        ],
        'controls' => [
            'create' => 'Create HTML Block',
            'update' => 'Update HTML Block',
            'delete' => 'Delete HTML Block',
        ],
    ],
];

<?php

return [
    'login' => [
        'title' => 'Sign In',
    ],
    'index' => [
        'title' => 'Users',
        'header' => 'Users',
    ],
    'create' => [
        'title' => 'Create User',
        'header' => 'New User',
    ],
    'edit' => [
        'title' => 'Edit User',
        'header' => 'Edit User: <b>:user</b>',
    ],

    'fields' => [
        'name' => [
            'label' => 'Full Name',
            'placeholder' => 'e.g. John Smith',
        ],
        'email' => [
            'label' => 'Email Address',
            'placeholder' => 'e.g. john@email.com',
        ],
        'password' => [
            'create_label' => 'Create Password',
            'change_label' => 'Change Password',
            'label' => 'Password',
            'unchanged' => 'Leave blank if password does not need to change.',
        ],
        'search' => [
            'placeholder' => 'Search',
        ],
        'cms_role' => [
            'label' => 'Role',
        ],
    ],

    'messages' => [
        'created' => 'User :name has been created',
        'updated' => 'User :name has been updated',
        'deleted' => 'User :name has been deleted',
        'last_updated' => 'Last Updated: :date',
    ],

    'controls' => [
        'password_show' => 'Show',
        'sign_in' => 'Sign In',
        'create' => 'Create User',
        'update' => 'Update User',
        'delete' => 'Delete User',
        'cancel' => 'Cancel',
    ],
];

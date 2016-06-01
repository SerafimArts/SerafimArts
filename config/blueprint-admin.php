<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Admin title
    |--------------------------------------------------------------------------
    */
    'title'      => 'Blueprint',

    /*
    |--------------------------------------------------------------------------
    | Admin URI path
    |--------------------------------------------------------------------------
    */
    'path'       => '/admin',

    /*
    |--------------------------------------------------------------------------
    | Authentication configuration
    |--------------------------------------------------------------------------
    |
    | Declared as [ `type` => `db_field_name` ]
    |
    */
    'credinals'  => [
        'login'    => 'email',
        'password' => 'password',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default database connection
    |--------------------------------------------------------------------------
    */
    'connection' => null,

    /*
    |--------------------------------------------------------------------------
    | Admin authentication permissions gate
    |--------------------------------------------------------------------------
    */
    'gate'       => \Serafim\BlueprintAdmin\Authorization\Kernel::GATE_AUTH_NAME,

    /*
    |--------------------------------------------------------------------------
    | Admin authorization middleware
    |--------------------------------------------------------------------------
    */
    'middleware' => \Serafim\BlueprintAdmin\Authorization\Middleware::MIDDLEWARE_AUTH_NAME,

    /*
    |--------------------------------------------------------------------------
    | Admin authorization middleware
    |--------------------------------------------------------------------------
    */
    'views'      => [
        'default' => [
            'read'  => 'bp::field.text.read',
            'write' => 'bp::field.text.write',
        ],

        \Serafim\BlueprintAdmin\Mapping\Image::class => [
            'read'  => 'bp::field.image.read',
            'write' => 'bp::field.image.write',
        ],

        \Serafim\BlueprintAdmin\Mapping\DateTime::class => [
            'read'  => 'bp::field.datetime.read',
            'write' => 'bp::field.datetime.write',
        ],

        \Serafim\BlueprintAdmin\Mapping\Boolean::class => [
            'read'  => 'bp::field.bool.read',
            'write' => 'bp::field.bool.write',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Blueprints config
    |--------------------------------------------------------------------------
    |
    | BlueprintClass => 'table'
    |
    */
    'blueprints' => [
        Blueprints\User::class     => 'users',
        Blueprints\Group::class    => 'user_groups',
        Blueprints\Article::class  => 'articles',
        Blueprints\Category::class => 'categories',
    ],
];
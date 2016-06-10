<?php
use Domains\User\User;
use Domains\User\Group;
use Domains\Article\Article;
use Domains\Article\Category;
use SleepingOwl\Admin\Navigation\Page;


return [
    [
        'title' => 'Dashboard',
        'icon'  => 'fa fa-dashboard',
        'url'   => route('admin.dashboard'),
    ],

    [
        'title' => 'Новости',
        'icon'  => 'fa fa-newspaper-o',
        'pages' => [
            (new Page(Article::class))
                ->setTitle('Новости')
                ->setIcon('fa fa-file-text'),

            (new Page(Category::class))
                ->setTitle('Категории')
                ->setIcon('fa fa-external-link'),

        ]
    ],

    [
        'title' => 'Пользователи',
        'icon'  => 'fa fa-user',
        'pages' => [
            (new Page(User::class))
                ->setTitle('Пользователи')
                ->setIcon('fa fa-user'),
            (new Page(Group::class))
                ->setTitle('Группы')
                ->setIcon('fa fa-users'),

        ]
    ],
];
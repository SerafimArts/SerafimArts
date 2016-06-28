<?php
use Domains\User\User;
use Domains\User\Group;
use Domains\Article\Part;
use Domains\Article\Article;
use Domains\Article\Category;
use Domains\Article\PartSeries;
use Domains\Article\MainPageArticle;
use SleepingOwl\Admin\Navigation\Page;


return [
    [
        'title' => 'Dashboard',
        'icon'  => 'fa fa-dashboard',
        'url'   => route('admin.dashboard'),
    ],

    [
        'title' => 'Главная',
        'icon'  => 'fa fa-home',
        'pages' => [
            (new Page(MainPageArticle::class))
                ->setTitle('Превьюшки')
                ->setIcon('fa fa-th-large'),
        ]
    ],

    [
        'title' => 'Серии статей',
        'icon'  => 'fa fa-server',
        'pages' => [
            (new Page(PartSeries::class))
                ->setTitle('Серии')
                ->setIcon('fa fa-server'),
            (new Page(Part::class))
                ->setTitle('Главы')
                ->setIcon('fa fa-paragraph'),

        ]
    ],

    [
        'title' => 'Статьи',
        'icon'  => 'fa fa-newspaper-o',
        'pages' => [
            (new Page(Article::class))
                ->setTitle('Статьи')
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
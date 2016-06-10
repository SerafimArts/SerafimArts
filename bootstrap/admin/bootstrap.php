<?php
use SleepingOwl\Admin\Model\ModelConfiguration;

$models = [
    \Domains\Article\Article::class  => \Admin\Pages\ArticlePage::class,
    \Domains\Article\Category::class => \Admin\Pages\CategoryPage::class,
    \Domains\User\User::class        => \Admin\Pages\UserPage::class,
    \Domains\User\Group::class       => \Admin\Pages\GroupPage::class,
];

foreach ($models as $model => $page) {
    AdminSection::registerModel($model, function (ModelConfiguration $model) use ($page) {
        return app($page, ['model' => $model]);
    });
}
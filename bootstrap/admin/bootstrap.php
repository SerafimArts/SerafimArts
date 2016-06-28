<?php
use SleepingOwl\Admin\Model\ModelConfiguration;

$models = [
    \Domains\Article\MainPageArticle::class     => \Admin\Pages\MainArticlePage::class,
    \Domains\Article\PartSeries::class          => \Admin\Pages\PartSeriesPage::class,
    \Domains\Article\Category::class            => \Admin\Pages\CategoryPage::class,
    \Domains\Article\Article::class             => \Admin\Pages\ArticlePage::class,
    \Domains\Article\Part::class                => \Admin\Pages\PartsPage::class,
    \Domains\User\Group::class                  => \Admin\Pages\GroupPage::class,
    \Domains\User\User::class                   => \Admin\Pages\UserPage::class,
];

foreach ($models as $model => $page) {
    AdminSection::registerModel($model, function (ModelConfiguration $model) use ($page) {
        return app($page, ['model' => $model]);
    });
}
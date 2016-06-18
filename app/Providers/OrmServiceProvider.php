<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 05.04.2016 23:54
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Providers;

use Domains\Article\Article;
use Domains\Article\Category;
use Domains\Article\MainPageArticle;
use Domains\Article\Repository\ArticleRepository;
use Domains\Article\Repository\EloquentArticleRepository;
use Domains\User\Group;
use Domains\User\Repository\EloquentUserRepository;
use Domains\User\Repository\UserRepository;
use Domains\User\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Observers\ContentRenderObserver;
use Observers\IdObserver;

/**
 * Class OrmServiceProvider
 * @package Providers
 */
class OrmServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ArticleRepository::class, function() {
            return new EloquentArticleRepository();
        });

        $this->app->singleton(UserRepository::class, function(Application $app) {
            return new EloquentUserRepository($app->make(Guard::class));
        });
    }

    /**
     * @throws \InvalidArgumentException
     * @return void
     */
    public function boot()
    {
        User::observe(IdObserver::class);
        Group::observe(IdObserver::class);
        Article::observe(IdObserver::class);
        Category::observe(IdObserver::class);
        MainPageArticle::observe(IdObserver::class);

        Article::observe(ContentRenderObserver::class);
    }
}
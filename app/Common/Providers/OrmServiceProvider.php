<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Common\Providers;

use Domains\Analytic\Analytic;
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
use Common\Observers\ContentRenderObserver;
use Common\Observers\IdObserver;

/**
 * Class OrmServiceProvider
 * @package Common\Providers
 */
class OrmServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ArticleRepository::class, function () {
            return new EloquentArticleRepository();
        });

        $this->app->singleton(UserRepository::class, function (Application $app) {
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
        Analytic::observe(IdObserver::class);
        Category::observe(IdObserver::class);
        MainPageArticle::observe(IdObserver::class);

        Article::observe(ContentRenderObserver::class);
    }
}
<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Common\Providers;

use Common\Observers\IdObserver;
use Domains\Analytic\Analytic;
use Domains\Analytic\Repository\AnalyticRepository;
use Domains\Analytic\Repository\EloquentAnalyticRepository;
use Domains\Article\Article;
use Domains\Article\Category;
use Domains\Article\MainPageArticle;
use Domains\Article\Observers\ColorGeneratorObserver;
use Domains\Article\Observers\ContentRenderObserver;
use Domains\Article\Observers\UrlGeneratorObserver;
use Domains\Article\Part;
use Domains\Article\PartSeries;
use Domains\Article\Repository\ArticleRepository;
use Domains\Article\Repository\EloquentArticleRepository;
use Domains\User\Group;
use Domains\User\Repository\EloquentUserRepository;
use Domains\User\Repository\UserRepository;
use Domains\User\User;
use Illuminate\Support\ServiceProvider;

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
        $this->app->singleton(ArticleRepository::class, EloquentArticleRepository::class);
        $this->app->singleton(UserRepository::class, EloquentUserRepository::class);
        $this->app->singleton(AnalyticRepository::class, EloquentAnalyticRepository::class);
    }

    /**
     * @throws \InvalidArgumentException
     * @return void
     */
    public function boot()
    {
        Part::observe(IdObserver::class);
        User::observe(IdObserver::class);
        Group::observe(IdObserver::class);
        Article::observe(IdObserver::class);
        Category::observe(IdObserver::class);
        Analytic::observe(IdObserver::class);
        PartSeries::observe(IdObserver::class);
        MainPageArticle::observe(IdObserver::class);
        Article::observe(UrlGeneratorObserver::class);
        Article::observe(ContentRenderObserver::class);
        Article::observe(ColorGeneratorObserver::class);
    }
}
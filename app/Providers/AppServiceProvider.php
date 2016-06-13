<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 26.04.2016 17:13
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Providers;

use Domains\Article\Article;
use Domains\Article\Category;
use Domains\User\Group;
use Domains\User\User;
use Illuminate\Support\ServiceProvider;
use Observers\ContentRenderObserver;
use Observers\IdObserver;

/**
 * Class AppServiceProvider
 * @package Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(IdObserver::class);
        Group::observe(IdObserver::class);
        Article::observe(IdObserver::class);
        Category::observe(IdObserver::class);

        Article::observe(ContentRenderObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

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
use Domains\User\Group;
use Domains\User\User;
use Illuminate\Support\ServiceProvider;
use Observers\IdObserver;

/**
 * Class OrmServiceProvider
 * @package Providers
 */
class OrmServiceProvider extends ServiceProvider
{
    /**
     * @throws \InvalidArgumentException
     * @return void
     */
    public function register()
    {
        User::observe(new IdObserver);
        Group::observe(new IdObserver);
        Article::observe(new IdObserver);
    }
}
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

use Illuminate\Support\ServiceProvider;


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

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $patches = [
            \Patches\AbstractContractAspect::class => '\\PhpDeal\\Aspect\\AbstractContractAspect'
        ];

        foreach ($patches as $class => $patchAlias) {
            class_alias($class, $patchAlias);
        }
    }
}

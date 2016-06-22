<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Common\Providers;

use Illuminate\Support\ServiceProvider;


/**
 * Class AppServiceProvider
 * @package Common\Providers
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
            \Common\Patches\AbstractContractAspect::class => '\\PhpDeal\\Aspect\\AbstractContractAspect'
        ];

        foreach ($patches as $class => $patchAlias) {
            class_alias($class, $patchAlias);
        }
    }
}

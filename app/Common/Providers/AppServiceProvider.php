<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Common\Providers;

use Carbon\Carbon;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Application;
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
        $isDebug = $this->app->make(Repository::class)->get('app.debug', false);
        if ($isDebug) {
            \DB::connection()->enableQueryLog();
        }

        Carbon::setLocale('ru');

        $patches = [
            \Common\Patches\AbstractContractAspect::class => '\\PhpDeal\\Aspect\\AbstractContractAspect'
        ];

        foreach ($patches as $class => $patchAlias) {
            class_alias($class, $patchAlias);
        }
    }
}

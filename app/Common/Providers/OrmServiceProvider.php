<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Common\Providers;

use Common\Orm\Mapping\Observe;
use Doctrine\Common\Annotations\Reader;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Config\Repository;
use Common\Orm\Mapping\Repository as OrmRepository;

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

    }

    /**
     * @return void
     */
    public function boot()
    {
        /** @var Reader $reader */
        $reader = $this->app->make(Reader::class);

        /** @var array $models */
        $models = $this->app->make(Repository::class)->get('app.models', []);
        
        foreach ($models as $model) {
            /** @var Observe $observer */
            $observer = $reader->getClassAnnotation(new \ReflectionClass($model), Observe::class);
            if ($observer !== null) {
                $observer->observe($model);
            }

            /** @var OrmRepository $repository */
            $repository = $reader->getClassAnnotation(new \ReflectionClass($model), OrmRepository::class);
            if ($repository !== null) {
                $this->app->singleton($repository->interface, function ($app) use ($model, $repository) {
                    return app($repository->class, ['model' => $model]);
                });
            }
        }
    }
}
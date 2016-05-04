<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 03.05.2016 19:56
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Annotations;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Annotations\Reader;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Cache\Repository as CacheInterface;
use Serafim\Annotations\Storage\DoctrineStorageBridge;

/**
 * Class LaravelServiceProvider
 * @package Serafim\Annotations
 */
class LaravelServiceProvider extends ServiceProvider
{
    const CONTAINER_KEY = 'annotations';

    /**
     * @return void
     * @throws \InvalidArgumentException
     */
    public function register()
    {
        AnnotationRegistry::registerLoader(function ($class) {
            return class_exists($class);
        });

        $this->app->singleton(Reader::class, function () {
            if ($this->app->make('config')->get('app.debug')) {
                return new AnnotationReader();
            }
            
            $storage = new DoctrineStorageBridge($this->app->make(CacheInterface::class));

            return new CachedReader(new AnnotationReader, $storage, false);
        });

        $this->app->alias(Reader::class, static::CONTAINER_KEY);
    }
}
<?php
/**
 * This file is part of BlueprintAdmin package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 02.05.2016 21:07
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint;

use Doctrine\Common\Annotations\Reader;
use Illuminate\Contracts\Container\Container;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Serafim\Blueprint\Authorization\Kernel as AuthKernel;
use Serafim\Blueprint\Authorization\Middleware;
use Serafim\Blueprint\Blueprints\MetadataInjectorMiddleware;
use Serafim\Blueprint\Repositories\ConfigRepository;
use Serafim\Blueprint\Repositories\IlluminateConfigRepository;
use Serafim\Blueprint\ViewComposers\Kernel as ViewKernel;

/**
 * Class LaravelServiceProvider
 * @package Serafim\Blueprint
 */
class LaravelServiceProvider extends BaseServiceProvider
{
    const MIDDLEWARE_INJECTOR_NAME = 'bp.metadata';
    const CONTROLLERS_NAMESPACE = '\\Serafim\\Blueprint\\Controllers';

    /**
     * @var ConfigRepository
     */
    private $config;

    /**
     * Register
     * @throws \InvalidArgumentException
     */
    public function register()
    {
        $this->config = $this->getConfigRepository();
    }

    /**
     * @return ConfigRepository
     */
    private function getConfigRepository()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/blueprint.php', 'blueprint');

        $this->app->singleton(ConfigRepository::class, function () {
            return $this->app->make(IlluminateConfigRepository::class);
        });

        return $this->app->make(ConfigRepository::class);
    }

    /**
     * @return void
     * @throws \LogicException
     */
    public function boot()
    {
        $this->app->singleton(MetadataManager::class, function (Container $container) {
            $manager = new MetadataManager($container->make(Reader::class));

            foreach ($this->config->get('blueprints.items') as $blueprint) {
                $manager->register($blueprint);
            }

            return $manager;
        });

        $this->app->make(AuthKernel::class);
        $this->app->make(ViewKernel::class);

        $this->registerRoutes();


        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'bp');
        $this->publishes([
            // Config
            __DIR__ . '/../config/blueprint.php' => config_path('blueprint.php'),

            // Views
            __DIR__ . '/../resources/views'      => base_path('resources/views/vendor/blueprint'),
        ]);
    }

    /**
     * @return void
     */
    private function registerRoutes()
    {
        /** @var Router $router */
        $route = $this->app->make(Router::class);
        $prefix = $this->config->get('path');
        $authrorizable = $this->config->get('middleware');
        $routeConfig = [
            'prefix'    => $prefix,
            'namespace' => static::CONTROLLERS_NAMESPACE,
        ];

        $route->middleware(Middleware::MIDDLEWARE_AUTH_NAME, Middleware::class);
        $route->middleware(static::MIDDLEWARE_INJECTOR_NAME, MetadataInjectorMiddleware::class);

        $route->group($routeConfig, function () use ($authrorizable, $route) {
            $injector = static::MIDDLEWARE_INJECTOR_NAME;
            $meta = $this->app->make(MetadataManager::class);

            require __DIR__ . '/routes.php';
        });
    }
}
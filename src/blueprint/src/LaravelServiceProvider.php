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

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Contracts\View\Factory;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Serafim\Blueprint\Authorization\AdminAuthorizable;
use Serafim\Blueprint\Authorization\Middleware;
use Serafim\Blueprint\Blueprints\MetadataInjectorMiddleware;
use Serafim\Blueprint\Repositories\BlueprintsRepository;
use Serafim\Blueprint\Repositories\ConfigRepository;
use Serafim\Blueprint\Repositories\EloquentEntityRepository;
use Serafim\Blueprint\Repositories\EntityRepository;
use Serafim\Blueprint\Repositories\IlluminateConfigRepository;
use Serafim\Blueprint\ViewComposers\BlueprintsComposer;
use Serafim\Blueprint\ViewComposers\ConfigComposer;

/**
 * Class LaravelServiceProvider
 * @package Serafim\Blueprint
 */
class LaravelServiceProvider extends BaseServiceProvider
{
    const MIDDLEWARE_INJECTOR_NAME  = 'bp.metadata';
    const MIDDLEWARE_AUTH_NAME      = 'bp.admin';
    const GATE_AUTH_NAME            = 'bp.auth';
    const CONTROLLERS_NAMESPACE     = '\\Serafim\\Blueprint\\Controllers';

    /**
     * @var ConfigRepository
     */
    private $config;

    /**
     * @var BlueprintsRepository
     */
    private $meta;

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
        $this->meta = $this->getMetadataRepository();

        $this->registerAuthGate();
        $this->registerViews();
        $this->registerRoutes();
        $this->registerEntityRepository();

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
    private function registerEntityRepository()
    {
        $repo = $this->app->make($this->config->get('blueprints.driver'));

        $this->app->singleton(EntityRepository::class, function() use ($repo) {
            return $repo;
        });
    }

    /**
     * @return BlueprintsRepository
     * @throws \LogicException
     */
    private function getMetadataRepository()
    {
        $reader = $this->app->make($this->config->get('blueprints.reader'));

        $this->app->singleton(BlueprintsRepository::class, function () use ($reader) {
            return $reader;
        });

        return $this->app->make(BlueprintsRepository::class);
    }

    /**
     * @return void
     */
    private function registerAuthGate()
    {
        /** @var GateContract $gate */
        $gate = $this->app->make(GateContract::class);

        $gate->define(static::GATE_AUTH_NAME, function (AdminAuthorizable $user) {
            return $user->isAdmin();
        });
    }

    /**
     * @return void
     */
    private function registerViews()
    {
        /** @var Factory $views */
        $views = $this->app->make(Factory::class);

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'bp');

        $views->composer(['bp::partials.*', 'bp::layout.master', 'bp::page.*'],  ConfigComposer::class);
        $views->composer('bp::partials.aside', BlueprintsComposer::class);
    }

    /**
     * @return void
     */
    private function registerRoutes()
    {
        /** @var Router $router */
        $route          = $this->app->make(Router::class);
        $prefix         = $this->config->get('path');
        $authrorizable  = $this->config->get('middleware');
        $routeConfig    = [
            'prefix' => $prefix,
            'namespace' => static::CONTROLLERS_NAMESPACE
        ];

        $route->middleware(static::MIDDLEWARE_AUTH_NAME, Middleware::class);
        $route->middleware(static::MIDDLEWARE_INJECTOR_NAME, MetadataInjectorMiddleware::class);

        $route->group($routeConfig, function () use ($authrorizable, $route) {
            $blueprints = $this->meta;
            $injector   = static::MIDDLEWARE_INJECTOR_NAME;

            require __DIR__ . '/routes.php';
        });
    }
}
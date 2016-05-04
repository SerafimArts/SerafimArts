<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 03.05.2016 20:57
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Blueprints;

use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Serafim\Blueprint\Repositories\BlueprintsRepository;

/**
 * Class MetadataInjectorMiddleware
 * @package Serafim\Blueprint\Blueprints
 */
class MetadataInjectorMiddleware
{
    /**
     * @param Request $request
     * @param \Closure $next
     * @return Response
     */
    public function handle(Request $request, \Closure $next)
    {
        /** @var Application $container */
        $container = app('app');

        $container->singleton(Metadata::class, function(Container $app) use ($request) {
            $resourceName = explode('.', $request->route()->getName())[2];

            /** @var BlueprintsRepository $repo */
            $repo = $app->make(BlueprintsRepository::class);

            return $repo->getByRoute($resourceName);
        });

        return $next($request);
    }
}
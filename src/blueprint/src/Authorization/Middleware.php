<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 03.05.2016 6:21
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Authorization;


use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class Middleware
 * @package Serafim\Blueprint\Authorization
 */
class Middleware
{
    /**
     * @param Request $request
     * @param \Closure $next
     * @return Response
     */
    public function handle(Request $request, \Closure $next)
    {
        /** @var Guard $guard */
        $guard = app(Guard::class);

        /** @var Gate $gate */
        $gate = app(Gate::class);

        /** @var string $gateName */
        $gateName = app(Repository::class)->get('blueprint.gate');

        /** @var Authorizable $user */
        $user = $guard->user();

        if ($guard->check() && $gate->check($gateName, ['user' => $user])) {
            return $next($request);
        }

        return redirect()->route('bp.auth');
    }
}
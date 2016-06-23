<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Interfaces\Http\Middleware;

use Carbon\Carbon;
use Domains\Analytic\Analytic;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Cookie;

/**
 * Class RequestsAnalytic
 * @package Interfaces\Http\Middleware
 */
class RequestsAnalytic
{
    const ANALYTIC_COOKIE_ID = 'analytic_id';

    /**
     * @param Request $request
     * @param \Closure $next
     * @return Response
     * @throws \InvalidArgumentException
     */
    public function handle(Request $request, \Closure $next)
    {
        if (!$request->hasCookie(static::ANALYTIC_COOKIE_ID)) {
            $hashId = Hash::make(random_int(0, 9999) . microtime());
            $request->cookies->set(static::ANALYTIC_COOKIE_ID, $hashId);
        }

        // TODO Move to deferred job
        Analytic::unguarded(function () use ($request) {
            Analytic::create([
                'identity' => $request->cookie(static::ANALYTIC_COOKIE_ID),
                'uri'      => $request->getUri(),
                'referrer' => $request->server('HTTP_REFERER', Analytic::DIRECT_REQUEST),
            ]);
        });

        /** @var Response $response */
        $response = $next($request);

        $identity = $request->cookies->get(static::ANALYTIC_COOKIE_ID);
        $response->withCookie(new Cookie(static::ANALYTIC_COOKIE_ID, $identity, Carbon::now()->addYear()));

        return $response;
    }
}
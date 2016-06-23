<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Admin\Middleware;

use Illuminate\Http\Request;
use Domains\User\AdminAuthorizable;
use Illuminate\Contracts\Auth\Guard;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AdminAuthenticate
 * @package Admin\Middleware
 */
class AdminAuthenticate
{
    /**
     * @var Guard
     */
    private $guard;

    /**
     * AdminAuthenticate constructor.
     * @param Guard $guard
     */
    public function __construct(Guard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * @param Request $request
     * @param \Closure $next
     * @return Response
     */
    public function handle(Request $request, \Closure $next)
    {
        if ($this->guard->check()) {
            /** @var AdminAuthorizable $user */
            $user = $this->guard->user();

            if ($user instanceof AdminAuthorizable && $user->isAdmin()) {
                return $next($request);
            }
        }

        return redirect()->route('login');
    }
}
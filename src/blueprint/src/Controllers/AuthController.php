<?php
/**
 * This file is part of BlueprintAdmin package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 02.05.2016 22:21
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Controllers;

use App\User;
use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class AuthController
 * @package Serafim\Blueprint\Controllers
 */
class AuthController extends Controller
{
    /**
     * @param Repository $config
     * @param Guard $guard
     * @param Gate $gate
     * @return View|RedirectResponse
     */
    public function login(Repository $config, Guard $guard, Gate $gate)
    {
        /** @var string $gateName */
        $gateName = $config->get('blueprint.gate');

        if ($guard->check() && $gate->check($gateName, ['user' => $guard->user()])) {
            return redirect()->route('bp.home');
        }

        return view('bp::page.auth');
    }

    /**
     * @param Repository $config
     * @param Request $request
     * @param Guard $auth
     * @return RedirectResponse
     * @throws HttpResponseException
     */
    public function loginAction(Request $request, Repository $config, Guard $auth)
    {
        $login    = $config->get('blueprint.credinals.login');
        $password = $config->get('blueprint.credinals.password');

        $this->validate($request, [
            'login'    => 'required',
            'password' => 'required',
        ]);

        $attempt = $auth->attempt([
            $login    => $request->get('login'),
            $password => $request->get('password'),
        ]);

        if (!$attempt) {
            return redirect()->route('bp.auth')
                ->withErrors([ trans('auth.failed') ]);
        }


        $gate = $config->get('blueprint.gate');
        /** @var Authenticatable|Authorizable $user */
        $user = $auth->user();

        if (!$user->can($gate)) {
            return redirect()->route('bp.auth')
                ->withErrors([ 'User has no permissions to login as administrator.' ]);
        }

        return redirect()->route('bp.home');
    }
}
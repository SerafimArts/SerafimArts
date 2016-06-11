<?php
/**
 * This file is part of SerafimArts package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Interfaces\Http\Controllers;

use Illuminate\Auth\Guard;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        return view('pages.auth');
    }

    /**
     * @param Guard $guard
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Guard $guard, Request $request)
    {
        list($login, $password) = [
            $request->get('login'),
            $request->get('password'),
        ];

        $auth = $guard->attempt([
            'name'     => $login,
            'password' => $password,
        ]);

        if ($auth) {
            return redirect()->route('admin.dashboard');
        }


        $auth = $guard->attempt([
            'email'    => $login,
            'password' => $password,
        ]);

        if ($auth) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('login');
    }

    /**
     * @param Guard $guard
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Guard $guard)
    {
        if ($guard->check()) {
            $guard->logout();
        }

        return redirect()->route('login');
    }
}
<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Interfaces\Http\Controllers;

use Illuminate\Auth\Guard;
use Illuminate\Http\Request;
use Domains\User\Repository\UserRepository;

/**
 * Class AuthController
 * @package Interfaces\Http\Controllers
 */
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
     * @param UserRepository $repository
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(UserRepository $repository, Request $request)
    {
        $this->validate($request, ['login' => 'required', 'password' => 'required']);

        $auth = $repository->authByLoginPassword($request->get('login'), $request->get('password'), true);

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
<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\User\Repository;

use Domains\User\User;
use Illuminate\Contracts\Auth\Authenticatable;
use PhpDeal\Annotation as Contract;
use Illuminate\Contracts\Auth\Guard;

/**
 * Class EloquentUserRepository
 * @package Domains\User\Repository
 */
class EloquentUserRepository implements UserRepository
{
    /**
     * @var Guard
     */
    private $guard;

    /**
     * EloquentUserRepository constructor.
     * @param Guard $guard
     */
    public function __construct(Guard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * @param string $login
     * @param string $password
     * @param bool $remember
     * @return Authenticatable|null
     *
     * @Contract\Verify("strlen($login) > 0 && strlen($login) <= 255")
     * @Contract\Verify("strlen($password) > 0 && strlen($password) <= 255")
     */
    public function authByLoginPassword(string $login, string $password, bool $remember = false)
    {
        $auth = $this->guard->attempt(['name' => $login, 'password' => $password], $remember);

        if ($auth) {
            return $this->guard->user();
        }

        $auth = $this->guard->attempt(['email' => $login, 'password' => $password], $remember);

        if ($auth) {
            return $this->guard->user();
        }

        return null;
    }
}
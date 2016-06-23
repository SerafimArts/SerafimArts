<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\User\Repository;

use Domains\User\User;
use Illuminate\Contracts\Auth\Guard;

/**
 * Interface UserRepository
 * @package Domains\User\Repository
 */
interface UserRepository
{
    /**
     * UserRepository constructor.
     * @param Guard $guard
     */
    public function __construct(Guard $guard);

    /**
     * @param string $login
     * @param string $password
     * @param bool $remember
     * @return User|null
     */
    public function authByLoginPassword(string $login, string $password, bool $remember = false);
}
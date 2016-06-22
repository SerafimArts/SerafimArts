<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\User;

use Domains\Base\BaseUser;
use PhpDeal\Annotation as Contract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


/**
 * @Contract\Invariant("is_uuid($this->id)")
 */
class User extends BaseUser implements
    AuthenticatableContract, AuthorizableContract, CanResetPasswordContract, AdminAuthorizable
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * @return bool
     */
    public function isAdmin() : bool
    {
        return $this->group->id === Group::GROUP_ADMIN;
    }
}
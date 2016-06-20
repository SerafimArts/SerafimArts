<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 05.04.2016 13:55
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\User;

use Carbon\Carbon;
use PhpDeal\Annotation as Contract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


/**
 * Class User
 * @package Domains\User
 *
 * @property-read string $id
 * @property-read string $name
 * @property-read string $email
 * @property-read string $password
 * @property-read string $avatar
 * @property-read string $remember_token
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 *
 * @property-read Group $group
 *
 * @Contract\Invariant("is_uuid($this->id)")
 */
class User extends Model implements
    AuthenticatableContract, AuthorizableContract, CanResetPasswordContract, AdminAuthorizable
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Relation
     */
    public function group() : Relation
    {
        return $this->hasOne(Group::class, 'id', 'group_id');
    }

    /**
     * @return bool
     */
    public function isAdmin() : bool
    {
        return $this->group->id === Group::GROUP_ADMIN;
    }
}
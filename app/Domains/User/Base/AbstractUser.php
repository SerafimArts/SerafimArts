<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\User\Base;

use Carbon\Carbon;
use Domains\User\Group;
use Domains\Article\Article;
use Illuminate\Support\Collection;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * @property string $id
 * @property string $group_id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $avatar
 * @property string $remember_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Group $group
 * @property-read Article[]|Collection $articles
 */
abstract class AbstractUser extends Model implements
    AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;
    /**
     * Model table name
     * @var string
     */
    protected $table = 'users';

    /**
     * Disable auto increment primary key
     * @var bool
     */
    public $incrementing = false;

    /**
     * Additional timestamps
     * @var array|bool
     */
    public $timestamps = [
        'created_at',
        'updated_at'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id'             => 'string',
        'group_id'       => 'string',
        'name'           => 'string',
        'email'          => 'string',
        'password'       => 'string',
        'avatar'         => 'string',
        'remember_token' => 'string',
        'created_at'     => 'datetime',
        'updated_at'     => 'datetime',
    ];

    /**
     * @return HasOne|Relation
     */
    public function group() : HasOne
    {
        return $this->hasOne(Group::class, 'id', 'group_id');
    }

    /**
     * @return HasMany|Relation
     */
    public function articles() : HasMany
    {
        return $this->hasMany(Article::class, 'user_id', 'id');
    }
}

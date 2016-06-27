<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Base;

use Domains\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;

/**
 * @property string $id
 * @property string $title
 *
 * @property-read User[]|Collection $users
 */
abstract class BaseUserGroup extends Model
{
    /**
     * Model table name
     * @var string
     */
    protected $table = 'user_groups';

    /**
     * Disable auto increment primary key
     * @var bool
     */
    public $incrementing = false;

    /**
     * Additional timestamps
     * @var array|bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $casts = [
        'id'    => 'string',
        'title' => 'string',
    ];

    /**
     * @return HasMany|Relation
     */
    public function users() : HasMany
    {
        return $this->hasMany(User::class, 'group_id', 'id');
    }
}

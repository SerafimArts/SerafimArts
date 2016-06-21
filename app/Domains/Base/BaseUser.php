<?php
namespace Domains\Base;

use Carbon\Carbon;
use Domains\Article\Article;
use Domains\User\Group;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;

/**
 * =============================================
 *   This is generated class. Do not touch it.
 * =============================================
 *
 * @date 21.06.2016 21:08:35
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
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
 *
 */
abstract class BaseUser extends Model
{
    /**
     * Model table name
     * @var string
     */
    protected $table = 'users';

    /**
     * Disable auto increment primary key
     * @var bool
     */
    public $incrementing = FALSE;

    /**
     * Additional timestamps
     * @var array|bool
     */
    public $timestamps = ['created_at', 'updated_at'];


    /**
     * @return HasOne|Relation
     */
    public function group()
    {
        return $this->hasOne(Group::class, 'group_id', 'id');
    }


    /**
     * @return HasMany|Relation
     */
    public function articles()
    {
        return $this->hasMany(Article::class, 'user_id', 'id');
    }

}

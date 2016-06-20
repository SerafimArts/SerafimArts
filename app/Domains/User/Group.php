<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 26.04.2016 16:41
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\User;

use PhpDeal\Annotation as Contract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class Group
 * @package Domains\User
 * @property-read string $id
 * @property-read string $title
 * 
 * @Contract\Invariant("is_uuid($this->id)")
 */
class Group extends Model
{
    const GROUP_USER  = '2dc71a6e-85d2-48db-9f1d-d1fe89b905b4';
    const GROUP_ADMIN = '4a1f7e61-3b32-4c23-8a80-bbb3272a7f12';

    /**
     * @var string
     */
    protected $table = 'user_groups';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Relation
     */
    public function users() : Relation
    {
        return $this->hasMany(User::class, 'id', 'group_id');
    }
}
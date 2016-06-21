<?php
namespace Domains\Base;

use ;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
 * @property string $title
 *
 * @property-read []|Collection $s
 *
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
    public $incrementing = FALSE;

    /**
     * Additional timestamps
     * @var array|bool
     */
    public $timestamps = FALSE;


    /**
     * @return HasMany|Relation
     */
    public function s()
    {
        return $this->hasMany(::class, 'group_id', 'id');
    }

}

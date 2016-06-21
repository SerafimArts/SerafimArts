<?php
namespace Domains\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

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
 * @property string $user_id
 * @property string $article_id
 * @property int $rate
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 *
 */
abstract class BaseLike extends Model
{
    /**
     * Model table name
     * @var string
     */
    protected $table = 'likes';

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

}

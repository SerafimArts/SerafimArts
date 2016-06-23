<?php
namespace Domains\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * =============================================
 *   This is generated class. Do not touch it.
 * =============================================
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @property string $id
 * @property string $identity
 * @property string $uri
 * @property string $referrer
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 *
 */
abstract class BaseAnalytic extends Model
{
    /**
     * Model table name
     * @var string
     */
    protected $table = 'analytic';

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

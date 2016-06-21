<?php
namespace Domains\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * =============================================
 *   This is generated class. Do not touch it.
 * =============================================
 *
 * Generated at: 21.06.2016 21:55:25
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @property string $email
 * @property string $token
 * @property Carbon $created_at
 *
 *
 */
abstract class BasePasswordReset extends Model
{
    /**
     * Model table name
     * @var string
     */
    protected $table = 'password_resets';

    /**
     * Additional timestamps
     * @var array|bool
     */
    public $timestamps = ['created_at'];

}

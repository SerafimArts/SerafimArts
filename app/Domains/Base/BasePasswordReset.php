<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $email
 * @property string $token
 * @property Carbon $created_at
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
    public $timestamps = [
        'created_at'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'email'      => 'string',
        'token'      => 'string',
        'created_at' => 'datetime',
    ];
}

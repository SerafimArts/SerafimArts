<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Analytic\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $identity
 * @property string $uri
 * @property string $referrer
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
abstract class AbstractAnalytic extends Model
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
        'id'         => 'string',
        'identity'   => 'string',
        'uri'        => 'string',
        'referrer'   => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}

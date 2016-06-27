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
 * @property string $id
 * @property string $user_id
 * @property string $article_id
 * @property string $content
 * @property string $content_rendered
 * @property bool $approved
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
abstract class BaseComment extends Model
{
    /**
     * Model table name
     * @var string
     */
    protected $table = 'comments';

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
        'id'               => 'string',
        'user_id'          => 'string',
        'article_id'       => 'string',
        'content'          => 'string',
        'content_rendered' => 'string',
        'approved'         => 'boolean',
        'created_at'       => 'datetime',
        'updated_at'       => 'datetime',
    ];
}

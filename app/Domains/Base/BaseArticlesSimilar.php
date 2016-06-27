<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Base;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $article_id
 * @property string $related_article_id
 * @property int $weight
 */
abstract class BaseArticlesSimilar extends Model
{
    /**
     * Model table name
     * @var string
     */
    protected $table = 'articles_similar';

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
        'id'                 => 'string',
        'article_id'         => 'string',
        'related_article_id' => 'string',
        'weight'             => 'int',
    ];
}

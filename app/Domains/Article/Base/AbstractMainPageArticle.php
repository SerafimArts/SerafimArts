<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Article\Base;

use Domains\Article\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * @property string $id
 * @property string $size
 * @property string $type
 * @property string $content
 * @property string $image
 * @property string $video
 * @property int $order_id
 * @property string $relation_id
 * @property string $button_description
 *
 * @property-read Article $relation
 */
abstract class AbstractMainPageArticle extends Model
{
    /**
     * Model table name
     * @var string
     */
    protected $table = 'article_previews';

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
        'size'               => 'string',
        'type'               => 'string',
        'content'            => 'string',
        'image'              => 'string',
        'video'              => 'string',
        'order_id'           => 'integer',
        'relation_id'        => 'string',
        'button_description' => 'string',
    ];

    /**
     * @return HasOne|Relation
     */
    public function relation() : HasOne
    {
        return $this->hasOne(Article::class, 'id', 'relation_id');
    }
}

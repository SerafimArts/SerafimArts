<?php
namespace Domains\Base;

use Domains\Article\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\Relation;

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
 * @property string $id
 * @property string $size
 * @property string $type
 * @property string $content
 * @property string $image
 * @property string $video
 * @property int $order_id
 * @property string $related_article
 * @property string $button_description
 *
 * @property-read Article $article
 *
 */
abstract class BaseArticlePreview extends Model
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
    public $incrementing = FALSE;

    /**
     * Additional timestamps
     * @var array|bool
     */
    public $timestamps = FALSE;


    /**
     * @return HasOne|Relation
     */
    public function article()
    {
        return $this->hasOne(Article::class, 'id', 'related_article');
    }

}

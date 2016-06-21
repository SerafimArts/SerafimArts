<?php
namespace Domains\Base;

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
 * @property string $article_id
 * @property string $related_article_id
 * @property int $weight
 *
 *
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
    public $incrementing = FALSE;

    /**
     * Additional timestamps
     * @var array|bool
     */
    public $timestamps = FALSE;

}

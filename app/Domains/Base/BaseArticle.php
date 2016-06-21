<?php
namespace Domains\Base;

use Carbon\Carbon;
use Domains\Article\Category;
use Domains\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
 * @property string $url
 * @property string $title
 * @property string $user_id
 * @property string $category_id
 * @property string $preview
 * @property string $preview_rendered
 * @property string $content
 * @property string $content_rendered
 * @property bool $is_draft
 * @property Carbon $publish_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read User $user
 * @property-read Category $category
 *
 */
abstract class BaseArticle extends Model
{
    /**
     * Model table name
     * @var string
     */
    protected $table = 'articles';

    /**
     * Disable auto increment primary key
     * @var bool
     */
    public $incrementing = FALSE;

    /**
     * Additional timestamps
     * @var array|bool
     */
    public $timestamps = [
        'publish_at',
        'created_at',
        'updated_at',
    ];


    /**
     * @return BelongsTo|Relation
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    /**
     * @return BelongsTo|Relation
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

}

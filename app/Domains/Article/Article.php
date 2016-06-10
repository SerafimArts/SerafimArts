<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 26.04.2016 15:56
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Article;

use Carbon\Carbon;
use Domains\User\User;
use Illuminate\Database\Eloquent\Model;
use Domains\Article\Enum\EnumArticleType;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class Article
 * @package Domains\Article
 *
 * @property-read string $id
 * @property-read string $url
 * @property-read string $title
 * @property-read string $type
 * @property-read string $user_id
 * @property-read string $category_id
 * @property-read string $preview
 * @property-read string $preview_rendered
 * @property-read string $content
 * @property-read string $content_rendered
 * @property-read bool $is_draft
 * @property-read Carbon $publish_at
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * 
 */
class Article extends Model
{
    /**
     * @var string
     */
    protected $table = 'articles';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    public $timestamps = [
        'created_at',
        'updated_at',
        'published_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Relation
     */
    public function user() : Relation
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Relation
     */
    public function category() : Relation
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
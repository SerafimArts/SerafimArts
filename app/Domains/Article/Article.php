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
 * @property-read string|null $image
 * @property-read string|null $video
 * @property-read int $size
 * @property-read string $user_id
 * @property-read string $category_id
 * @property-read string $preview
 * @property-read string $preview_rendered
 * @property-read string $content
 * @property-read string $content_rendered
 * @property-read string $content_open
 * @property-read bool $is_draft
 * @property-read bool $is_main
 * @property-read Carbon $publish_at
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 *
 * @property-read User $user
 * @property-read Category $category
 *
 * @method onMainPage()
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
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Relation
     */
    public function category() : Relation
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    /**
     * @param $query
     * @return mixed
     */
    public static function scopeOnMainPage($query)
    {
        return $query->where('is_main', true);
    }
}
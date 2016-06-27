<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Base;

use Carbon\Carbon;
use Domains\Article\Category;
use Domains\Article\Part;
use Domains\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;

/**
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
 * @property-read Part $part
 * @property-read Part[]|Collection $parts
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
    public $incrementing = false;

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
     * @var array
     */
    public $casts = [
        'id'               => 'string',
        'url'              => 'string',
        'title'            => 'string',
        'user_id'          => 'string',
        'category_id'      => 'string',
        'preview'          => 'string',
        'preview_rendered' => 'string',
        'content'          => 'string',
        'content_rendered' => 'string',
        'is_draft'         => 'boolean',
        'publish_at'       => 'datetime',
        'created_at'       => 'datetime',
        'updated_at'       => 'datetime',
    ];

    /**
     * @return BelongsTo|Relation
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return BelongsTo|Relation
     */
    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * @return HasOne|Relation
     */
    public function part() : HasOne
    {
        return $this->hasOne(Part::class, 'article_id', 'id');
    }

    /**
     * @return Part[]|Collection
     */
    public function getPartsAttribute()
    {
        $key = 'parts';

        if ($this->relationLoaded($key)) {
            return $this->relations[$key];
        }

        return $this->relations[$key] = Part::query()
            ->with('article')
            ->where('series_id', $this->part->series_id)
            ->get();
    }
}

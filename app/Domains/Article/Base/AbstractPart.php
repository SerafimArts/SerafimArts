<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Article\Base;

use Domains\Article\Part;
use Domains\Article\Article;
use Domains\Article\PartSeries;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $series_id
 * @property int $part
 * @property string $article_id
 *
 * @property-read Article $article
 * @property-read PartSeries $series
 * @property-read Part $next
 * @property-read Part $prev
 */
abstract class AbstractPart extends Model
{
    /**
     * @var string
     */
    protected $table = 'parts';

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
        'id'         => 'string',
        'series_id'  => 'string',
        'part'       => 'integer',
        'article_id' => 'string',
    ];

    /**
     * @return BelongsTo|Relation
     */
    public function article() : BelongsTo
    {
        return $this->belongsTo(Article::class, 'article_id', 'id');
    }

    /**
     * @param int $pageId
     * @return Model|Part
     */
    private function getArticleByPart(int $pageId)
    {
        $key = 'article-' . $pageId;

        if ($this->relationLoaded($key)) {
            return $this->relations[$key];
        }

        return $this->relations[$key] = static::query()
            ->with('article')
            ->where('series_id', $this->series_id)
            ->where('part', $pageId)
            ->take(1)
            ->first();
    }

    /**
     * @return Model|null|static
     */
    public function getNextAttribute()
    {
        return $this->getArticleByPart($this->part + 1);
    }

    /**
     * @return Model|null|static
     */
    public function getPrevAttribute()
    {
        return $this->getArticleByPart($this->part - 1);
    }

    /**
     * @return BelongsTo|Relation
     */
    public function series() : BelongsTo
    {
        return $this->belongsTo(PartSeries::class, 'series_id', 'id');
    }
}
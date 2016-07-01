<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Article\Base;

use Carbon\Carbon;
use Domains\Article\Part;
use Domains\Article\Article;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $id
 * @property string $title
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Article[]|Collection $articles
 * @property-read Part[]|Collection $parts
 */
abstract class AbstractPartSeries extends Model
{
    /**
     * @var string
     */
    protected $table = 'part_series';

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
        'id'         => 'string',
        'title'      => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @return BelongsToMany|Relation
     */
    public function articles() : BelongsToMany
    {
        return $this
            ->belongsToMany(Article::class, 'article_parts', 'series_id', 'article_id')
            ->withPivot('part');
    }

    /**
     * @return HasMany|Relation
     */
    public function parts()
    {
        return $this->hasMany(Part::class, 'series_id', 'id');
    }
}
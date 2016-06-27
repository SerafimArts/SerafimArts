<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Base;

use Carbon\Carbon;
use Domains\Article\Article;
use Domains\Article\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;

/**
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $parent_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Article[]|Collection $articles
 * @property-read Category $parent
 */
abstract class BaseCategory extends Model
{
    /**
     * Model table name
     * @var string
     */
    protected $table = 'categories';

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
        'id'          => 'string',
        'title'       => 'string',
        'description' => 'string',
        'parent_id'   => 'string',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];
    
    /**
     * @return HasMany|Relation
     */
    public function articles() : HasMany
    {
        return $this->hasMany(Article::class, 'category_id', 'id');
    }

    /**
     * @return HasOne|Relation
     */
    public function parent() : HasOne
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }
}

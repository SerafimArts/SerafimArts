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
use PhpDeal\Annotation as Contract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class Category
 * @package Domains\Article
 *
 * @property-read string $id
 * @property-read string $title
 * @property-read string $description
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 *
 * @property-read Category[]|Collection $articles
 *
 * @Contract\Invariant("is_uuid($this->id)")
 */
class Category extends Model
{
    /**
     * @var string
     */
    protected $table = 'categories';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Relation
     */
    public function articles() : Relation
    {
        return $this->hasMany(Category::class, 'id', 'category_id');
    }
}
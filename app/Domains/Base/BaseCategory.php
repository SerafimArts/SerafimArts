<?php
namespace Domains\Base;

use Carbon\Carbon;
use Domains\Article\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;

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
 * @property string $title
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Article[]|Collection $articles
 *
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
    public $incrementing = FALSE;

    /**
     * Additional timestamps
     * @var array|bool
     */
    public $timestamps = ['created_at', 'updated_at'];


    /**
     * @return HasMany|Relation
     */
    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id', 'id');
    }

}

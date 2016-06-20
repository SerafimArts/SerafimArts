<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 18.06.2016 07:00
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Article;

use PhpDeal\Annotation as Contract;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Traits\OrderableModel;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class MainPageArticle
 * @package Domains\Article
 *
 * @property-read string $id
 * @property-read string $size
 * @property-read string $type
 * @property-read string|null $content
 * @property-read string|null $image
 * @property-read int|null $order_id
 * @property-read string|null $related_article
 * @property-read string $button_description
 *
 * @Contract\Invariant("is_uuid($this->id)")
 * @Contract\Invariant("enum_of($this->type, \Domains\Article\Enum\EnumArticleType::class)")
 * @Contract\Invariant("enum_of($this->size, \Domains\Article\Enum\EnumSizeType::class)")
 */
class MainPageArticle extends Model
{
    use OrderableModel;

    /**
     * @var string
     */
    protected $table = 'article_previews';
    
    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var bool
     */
    public $timestamps = false;
    
    /**
     * @return string
     */
    public function getOrderField() : string
    {
        return 'order_id';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Relation
     */
    public function relation() : Relation
    {
        return $this->hasOne(Article::class, 'id', 'related_article');
    }
}
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
use Illuminate\Database\Eloquent\Relations\Relation;
use SleepingOwl\Admin\Traits\OrderableModel;

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
 */
class MainPageArticle extends \Eloquent
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
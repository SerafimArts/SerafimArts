<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Article;

use Common\Orm\Mapping as ORM;
use Common\Observers\IdObserver;
use PhpDeal\Annotation as Contract;
use Domains\Article\Enum\EnumSizeType;
use Domains\Article\Enum\EnumArticleType;
use SleepingOwl\Admin\Traits\OrderableModel;
use Domains\Article\Base\AbstractMainPageArticle;

/**
 * @uses IdObserver
 * @ORM\Observe(IdObserver::class)
 * 
 * @Contract\Invariant("is_uuid($this->id)")
 * @Contract\Invariant("enum_of($this->type, \Domains\Article\Enum\EnumArticleType::class)")
 */
class MainPageArticle extends AbstractMainPageArticle
{
    use OrderableModel;

    /**
     * @return string
     */
    public function getOrderField() : string
    {
        return 'order_id';
    }

    /**
     * @param EnumArticleType|string $type
     */
    public function setTypeAttribute($type)
    {
        $this->attributes['type'] = EnumArticleType::get($type)->getValue();
    }

    /**
     * @param EnumSizeType|string $size
     */
    public function setSizeAttribute($size)
    {
        $this->attributes['size'] = EnumSizeType::get($size)->getValue();
    }
}
<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Article;

use PhpDeal\Annotation as Contract;
use Domains\Base\BaseArticlePreview;
use Domains\Article\Enum\EnumSizeType;
use Domains\Article\Enum\EnumArticleType;
use SleepingOwl\Admin\Traits\OrderableModel;

/**
 * @Contract\Invariant("is_uuid($this->id)")
 * @Contract\Invariant("enum_of($this->type, \Domains\Article\Enum\EnumArticleType::class)")
 * @Contract\Invariant("enum_of($this->size, \Domains\Article\Enum\EnumSizeType::class)")
 */
class MainPageArticle extends BaseArticlePreview
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
        $this->attributes['type'] = EnumArticleType::get($type);
    }

    /**
     * @param EnumSizeType|string $size
     */
    public function setSizeAttribute($size)
    {
        $this->attributes['type'] = EnumSizeType::get($size);
    }
}
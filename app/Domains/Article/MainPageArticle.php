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
use SleepingOwl\Admin\Traits\OrderableModel;
use Illuminate\Database\Eloquent\Relations\Relation;

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
     * {@inheritdoc}
     */
    public function relation() : Relation
    {
        return $this->article();
    }
}
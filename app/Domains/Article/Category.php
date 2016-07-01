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
use Common\Generators\ColorGenerator;
use Domains\Article\Base\AbstractCategory;
use Domains\Article\Observers\ColorGeneratorObserver;

/**
 * @uses IdObserver
 * @uses ColorGeneratorObserver
 *
 * @ORM\Observe({
 *     IdObserver::class,
 *     ColorGeneratorObserver::class
 * })
 *
 * @Contract\Invariant("is_uuid($this->id)")
 */
class Category extends AbstractCategory
{
    /**
     * @return $this
     */
    public function changeColor()
    {
        $this->color = app(ColorGenerator::class)->make();
        return $this;
    }
}
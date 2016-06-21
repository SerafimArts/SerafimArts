<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Article;


use Domains\Base\BaseCategory;
use PhpDeal\Annotation as Contract;

/**
 * @Contract\Invariant("is_uuid($this->id)")
 */
class Category extends BaseCategory
{

}
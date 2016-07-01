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
use Domains\Article\Base\AbstractPartSeries;

/**
 * @uses IdObserver
 * @ORM\Observe(IdObserver::class)
 */
class PartSeries extends AbstractPartSeries
{

}
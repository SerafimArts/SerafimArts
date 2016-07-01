<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Analytic;

use Common\Orm\Mapping as ORM;
use Common\Observers\IdObserver;
use Domains\Analytic\Base\AbstractAnalytic;
use Domains\Analytic\Repository\EloquentAnalyticRepository;

/**
 * @uses IdObserver
 * @uses EloquentAnalyticRepository
 *
 * @ORM\Observe(IdObserver::class)
 * @ORM\Repository(class=EloquentAnalyticRepository::class)
 */
class Analytic extends AbstractAnalytic
{
    const DIRECT_REQUEST = 'Direct';
}
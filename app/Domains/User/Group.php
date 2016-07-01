<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\User;

use Common\Orm\Mapping as ORM;
use Common\Observers\IdObserver;
use PhpDeal\Annotation as Contract;
use Domains\User\Base\AbstractUserGroup;

/**
 * @uses IdObserver
 * @ORM\Observe(IdObserver::class)
 *
 * @Contract\Invariant("is_uuid($this->id)")
 */
class Group extends AbstractUserGroup
{
    const GROUP_USER  = '2dc71a6e-85d2-48db-9f1d-d1fe89b905b4';
    const GROUP_ADMIN = '4a1f7e61-3b32-4c23-8a80-bbb3272a7f12';

}
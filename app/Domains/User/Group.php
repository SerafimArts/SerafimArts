<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\User;

use Domains\Base\BaseUserGroup;
use PhpDeal\Annotation as Contract;

/**
 * @Contract\Invariant("is_uuid($this->id)")
 */
class Group extends BaseUserGroup
{
    const GROUP_USER  = '2dc71a6e-85d2-48db-9f1d-d1fe89b905b4';
    const GROUP_ADMIN = '4a1f7e61-3b32-4c23-8a80-bbb3272a7f12';

}
<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 26.04.2016 16:46
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Mappers\User;

use Analogue\ORM\EntityMap;

/**
 * Class GroupMapper
 * @package Mappers\User
 */
class GroupMapper extends EntityMap
{
    /**
     * @var string
     */
    protected $table = 'user_groups';
}
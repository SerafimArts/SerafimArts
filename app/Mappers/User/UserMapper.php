<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 05.04.2016 13:55
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Mappers\User;

use Analogue\ORM\EntityMap;

/**
 * Class UserMapper
 * @package Mappers\User
 */
class UserMapper extends EntityMap
{
    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * @var bool
     */
    public $timestamps = true;
}
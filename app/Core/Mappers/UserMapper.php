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
namespace Core\Mappers;

use Analogue\ORM\EntityMap;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserMapper
 * @package Core\Mappers
 */
class UserMapper extends EntityMap
{
    protected $table = 'users';
}
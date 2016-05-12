<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 12.05.2016 4:27
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Mapping;

use Doctrine\Common\Annotations\Annotation\Target;

/**
 * Class Blueprint
 * @package Serafim\Blueprint\Mapping
 * @Annotation
 * @Target("PROPERTY")
 */
class PrimaryKey
{
    /**
     * @var mixed
     */
    public $name = null;
}
<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 03.05.2016 7:46
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
 * @Target("CLASS")
 */
class Blueprint
{
    /**
     * @var mixed
     */
    public $title = null;

    /**
     * @var mixed
     */
    public $icon = null;

    /**
     * @var mixed
     */
    public $route = null;

    /**
     * @var int
     */
    public $perPage = 10;
}
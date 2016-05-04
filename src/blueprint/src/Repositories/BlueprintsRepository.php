<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 03.05.2016 20:31
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Repositories;

use Serafim\Blueprint\Blueprints\Metadata;

/**
 * Interface BlueprintsRepository
 * @package Serafim\Blueprint\Repositories
 */
interface BlueprintsRepository
{
    /**
     * @param string $class
     * @return BlueprintsRepository
     */
    public function add($class);

    /**
     * @param string $class
     * @return Metadata
     */
    public function get($class);

    /**
     * @param string $name
     * @return Metadata
     */
    public function getByRoute($name);

    /**
     * @return array|\Traversable|Metadata[]
     */
    public function all();
}
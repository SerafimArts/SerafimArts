<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 03.05.2016 19:42
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Repositories;

/**
 * Interface ConfigRepository
 * @package Serafim\Blueprint\Repositories
 */
interface ConfigRepository
{
    /**
     * @param string $name
     * @param null $default
     * @return mixed
     */
    public function get($name, $default = null);

    /**
     * @return array
     */
    public function all();
}
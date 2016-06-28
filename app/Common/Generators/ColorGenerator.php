<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Common\Generators;

/**
 * Class ColorGenerator
 * @package Common\Generators
 */
class ColorGenerator
{
    /**
     * @return string
     */
    public function make()
    {
        return strtolower(sprintf('%06X', random_int(0, 0xFFFFFF)));
    }
}
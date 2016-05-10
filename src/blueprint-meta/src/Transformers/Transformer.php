<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 10.05.2016 1:54
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Transformers;

/**
 * Interface Transformer
 * @package Serafim\Blueprint\Transformers
 */
interface Transformer
{
    /**
     * @param mixed $value
     * @return bool
     */
    public function check($value);

    /**
     * @param $value
     * @return array
     */
    public function transform($value);
}
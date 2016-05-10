<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 10.05.2016 2:38
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Transformers;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Class ArrayTransformer
 * @package Serafim\Blueprint\Transformers
 */
class ArrayTransformer implements Transformer
{
    /**
     * @param mixed|array $value
     * @return bool
     */
    public function check($value)
    {
        return is_array($value);
    }

    /**
     * @param array $value
     * @return array
     */
    public function transform($value)
    {
        return $value;
    }
}
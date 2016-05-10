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
 * Class ArrayableTransformer
 * @package Serafim\Blueprint\Transformers
 */
class ArrayableTransformer implements Transformer
{
    /**
     * @param mixed|Arrayable $value
     * @return bool
     */
    public function check($value)
    {
        return $value instanceof Arrayable;
    }

    /**
     * @param Arrayable $value
     * @return array
     */
    public function transform($value)
    {
        return $value->toArray();
    }
}
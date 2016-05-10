<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 10.05.2016 1:57
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Transformers;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class RequestTransformer
 * @package Serafim\Blueprint\Transformers
 */
class RequestTransformer implements Transformer
{
    /**
     * @param mixed|Request $value
     * @return bool
     */
    public function check($value)
    {
        return $value instanceof Request;
    }

    /**
     * @param Request $value
     * @return bool
     */
    public function transform($value)
    {
        return $value->query->all();
    }
}
<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 10.05.2016 1:53
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint;

use Serafim\Blueprint\Transformers\ArrayableTransformer;
use Serafim\Blueprint\Transformers\ArrayTransformer;
use Serafim\Blueprint\Transformers\ModelTransformer;
use Serafim\Blueprint\Transformers\RequestTransformer;
use Serafim\Blueprint\Transformers\Transformer;

/**
 * Class Factory
 * @package Serafim\Blueprint
 */
class Factory
{
    /**
     * @var array|Transformer[]
     */
    private $transformers = [];

    /**
     * Factory constructor.
     */
    public function __construct()
    {
        $this->transformers = [
            new ArrayTransformer(),
            new RequestTransformer(),
            new ModelTransformer(),
            new ArrayableTransformer()
        ];
    }

    /**
     * @param string $blueprint
     * @param mixed $data
     * @return object
     */
    public function create($blueprint, $data)
    {
        $attributes = $this->transform($data);

        $instance   = (new \ReflectionClass($blueprint))
            ->newInstanceWithoutConstructor();

        $reflection = (new \ReflectionObject($instance));

        foreach ($attributes as $attribute => $value) {
            $this->fillAttribute($reflection, $instance, $attribute, $value);
        }

        return $instance;
    }

    /**
     * @param \ReflectionObject $reflection
     * @param object $context
     * @param string $field
     * @param mixed $value
     * @return void
     */
    private function fillAttribute(\ReflectionObject $reflection, $context, $field, $value)
    {
        if ($reflection->hasProperty($field)) {
            $property = $reflection->getProperty($field);

            if (!$property->isPublic()) {
                $property->setAccessible(true);
            }

            if ($property->isStatic()) {
                $property->setValue($value);
            } else {
                $property->setValue($context, $value);
            }
        }
    }

    /**
     * @param mixed $data
     * @return array
     */
    private function transform($data)
    {
        if (is_array($data)) {
            return $data;
        }

        /** @var Transformer $transformer */
        foreach ($this->transformers as $transformer) {
            if ($transformer->check($data)) {
                return $transformer->transform($data);
            }
        }

        return [];
    }
}
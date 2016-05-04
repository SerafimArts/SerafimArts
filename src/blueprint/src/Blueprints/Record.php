<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 03.05.2016 21:48
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Blueprints;

use Serafim\Blueprint\Mapping\Blueprint;
use Serafim\Blueprint\Mapping\Field;

/**
 * Class Record
 * @package Serafim\Blueprint\Blueprints
 * @property-read Blueprint $class
 * @property-read Property[] $properties
 */
class Record
{
    /**
     * @var Metadata
     */
    private $meta;

    /**
     * @var array
     */
    private $values = [];

    /**
     * @var array|Property[]
     */
    private $properties = [];

    /**
     * Record constructor.
     * @param Metadata $metadata
     * @param array $values
     */
    public function __construct(Metadata $metadata, array $values = [])
    {
        $this->meta = $metadata;
        $this->values = $values;

        foreach ($this->meta->properties as $name => $field) {
            $value = array_key_exists($name, $values) ? $values[$name] : $field->value;
            $this->properties[] = new Property($field, $name, $value);
        }
    }

    /**
     * @param $name
     * @return array|Blueprint|Field[]|string
     * @throws \LogicException
     */
    public function __get($name)
    {
        switch ($name) {
            case 'properties':
                return $this->properties;
            case 'class':
                return $this->meta->class;
        }

        throw new \LogicException('Field ' . $name . ' not defined');
    }
}
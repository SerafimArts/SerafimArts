<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 10.05.2016 4:58
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Presenter;

use Serafim\Blueprint\Mapping\PrimaryKey;
use Serafim\Blueprint\Metadata;
use Serafim\Properties\Getters;

/**
 * Class Record
 * @package Serafim\Blueprint\Presenter
 * @property-read PrimaryKey $primary_key
 * @property-read array|Property[] $properties
 * @property-read array|Property[] $writable_properties
 * @property-read array|Property[] $readable_properties
 */
class Record
{
    use Getters;

    /**
     * @var Metadata
     */
    private $metadata;

    /**
     * @var object
     */
    private $blueprint;

    /**
     * Record constructor.
     * @param Metadata $metadata
     * @param $blueprint
     */
    public function __construct(Metadata $metadata, $blueprint)
    {
        $this->metadata = $metadata;
        $this->blueprint = $blueprint;
    }

    /**
     * @return \Generator|Property[]
     */
    public function getProperties()
    {
        $properties = $this->metadata->properties;

        foreach ($properties as $meta) {
            $value = $this->getValue($this->blueprint, $meta->name);

            yield new Property(
                $this->blueprint,
                $this->metadata->getPropertyAnnotation($meta->name),
                $value
            );
        }
    }

    /**
     * @param object $blueprint
     * @param string $field
     * @return mixed
     */
    private function getValue($blueprint, $field)
    {
        $property = new \ReflectionProperty($blueprint, $field);

        if (!$property->isPublic()) {
            $property->setAccessible(true);
        }

        return $property->isStatic()
            ? $property->getValue()
            : $property->getValue($this->blueprint);
    }

    /**
     * @return PrimaryKeyProperty
     */
    public function getPrimaryKey()
    {
        $meta = $this->metadata->getPrimaryKey();

        return new PrimaryKeyProperty(
            $meta,
            $this->getValue($this->blueprint, $meta->name)
        );
    }

    /**
     * @return \Generator|Property[]
     */
    public function getReadableProperties()
    {
        /** @var Property $property */
        foreach ($this->getProperties() as $property) {
            if ($property->read) {
                yield $property;
            }
        }
    }

    /**
     * @return \Generator|Property[]
     */
    public function getWritableProperties()
    {
        /** @var Property $property */
        foreach ($this->getProperties() as $property) {
            if ($property->write) {
                yield $property;
            }
        }
    }
}
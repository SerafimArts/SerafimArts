<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 10.05.2016 2:59
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Presenter;

use Serafim\Blueprint\Mapping\Blueprint;
use Serafim\Blueprint\Mapping\PrimaryKey;
use Serafim\Blueprint\Mapping\Property;
use Serafim\Blueprint\Metadata;
use Serafim\Properties\Getters;

/**
 * Class ClassInformation
 * @package Serafim\Blueprint\Presenter
 * @property-read string $entity
 * @property-read string $title
 * @property-read string $icon
 * @property-read string $route
 * @property-read int $perPage
 * @property-read Blueprint $info
 * @property-read PrimaryKey $primary_key
 * @property-read int $properties_count
 * @property-read int $readable_properties_count
 * @property-read int $writable_properties_count
 * @property-read \Traversable|string[] $properties
 * @property-read \Traversable|string[] $readable_properties
 * @property-read \Traversable|string[] $writable_properties
 */
class ClassInformation
{
    use Getters {
        Getters::__get as __gettersGet;
    }
    
    /**
     * @var Metadata
     */
    private $meta;

    /**
     * ClassInformation constructor.
     * @param Metadata $meta
     */
    public function __construct(Metadata $meta)
    {
        $this->meta = $meta;
    }

    /**
     * @param $name
     * @return mixed
     * @throws \LogicException
     * @throws \InvalidArgumentException
     */
    public function __get($name)
    {
        $reflection = new \ReflectionClass($this->meta->class);
        if ($reflection->hasProperty($name)) {
            return $this->meta->class->{$name};
        }

        return $this->__gettersGet($name);
    }

    /**
     * @return PrimaryKey
     */
    public function getPrimaryKey()
    {
        return $this->meta->getPrimaryKey();
    }

    /**
     * @return Blueprint
     */
    public function getInfo()
    {
        return $this->meta->class;
    }

    /**
     * @return int
     */
    public function getPropertiesCount()
    {
        return count(iterator_to_array($this->getProperties()));
    }

    /**
     * @return int
     */
    public function getReadablePropertiesCount()
    {
        return count(iterator_to_array($this->getReadableProperties()));
    }

    /**
     * @return int
     */
    public function getWritablePropertiesCount()
    {
        return count(iterator_to_array($this->getWritableProperties()));
    }

    /**
     * @return \Generator|Property[]
     */
    public function getProperties()
    {
        foreach ($this->meta->properties as $property) {
            yield $property->title;
        }
    }

    /**
     * @return \Generator|Property[]
     */
    public function getReadableProperties()
    {
        foreach ($this->meta->properties as $property) {
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
        foreach ($this->meta->properties as $property) {
            if ($property->write) {
                yield $property;
            }
        }
    }
}
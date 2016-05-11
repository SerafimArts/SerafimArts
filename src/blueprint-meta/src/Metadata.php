<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 09.05.2016 23:29
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint;

use Doctrine\Common\Annotations\Reader;
use Illuminate\Support\Str;
use Serafim\Blueprint\Mapping\Blueprint;
use Serafim\Blueprint\Mapping\Property;
use Serafim\Blueprint\Mapping\Relation;
use Serafim\Properties\Getters;

/**
 * Class Metadata
 * @package Serafim\Blueprint
 * @property-read Blueprint $class
 * @property-read Property[] $properties
 * @property-read string $blueprint
 * @property-read array|Relation[] $relations
 */
class Metadata
{
    use Getters;

    /**
     * @var string
     */
    private $className;

    /**
     * @var \ReflectionClass
     */
    private $reflection;

    /**
     * @var Reader
     */
    private $reader;

    /**
     * @var Blueprint
     */
    private $classMetadata = null;

    /**
     * @var array|Property[]
     */
    private $propertiesMetadata = null;

    /**
     * Metadata constructor.
     * @param Reader $reader
     * @param string $class
     * @throws \LogicException
     */
    public function __construct(Reader $reader, $class)
    {
        $this->reader = $reader;
        $this->className = $class;
        $this->reflection = new \ReflectionClass($class);
        $this->classMetadata = $this->getClassMetadata();
        $this->propertiesMetadata = $this->getPropertiesMetadata();
    }

    /**
     * @return string
     */
    public function getBlueprint()
    {
        return $this->className;
    }

    /**
     * @return Blueprint
     * @throws \LogicException
     */
    private function getClassMetadata()
    {
        /** @var Blueprint $blueprint */
        $blueprint = $this->reader->getClassAnnotation($this->reflection, Blueprint::class);

        if (!$blueprint) {
            $error = sprintf('Blueprint class %s must be declare a %s class', $this->reflection->name,
                Blueprint::class);
            throw new \LogicException($error);
        }

        if (!$blueprint->title) {
            $blueprint->title = $this->reflection->getShortName();
        }

        if (!$blueprint->route) {
            $blueprint->route = Str::snake($this->reflection->getShortName());
        }

        $blueprint->title = (string)$blueprint->title;
        $blueprint->route = (string)$blueprint->route;

        return $blueprint;
    }

    /**
     * @return array|Property[]
     */
    private function getPropertiesMetadata()
    {
        $result = [];
        $instance = $this->reflection->newInstanceWithoutConstructor();
        $properties = $this->reflection->getProperties();

        /** @var \ReflectionProperty $property */
        foreach ($properties as $property) {
            /** @var Property $meta */
            $meta = $this->reader->getPropertyAnnotation($property, Property::class);

            if (!$meta) {
                continue;
            }

            if ($meta->title === null) {
                $meta->title = ucfirst((string)$property->name);
            }

            if ($meta->value === null && $property->isDefault()) {
                if (!$property->isPublic()) {
                    $property->setAccessible(true);
                }
                $meta->value = $property->getValue($instance);
            }

            if ($meta->name === null) {
                $meta->name = $property->name;
            }

            $result[$property->name] = $meta;
        }

        return $result;
    }

    /**
     * @return \Generator|Relation[]
     */
    public function getRelations()
    {
        foreach ($this->properties as $property) {
            if ($property instanceof Relation) {
                yield $property;
            }
        }
    }

    /**
     * @param string $name
     * @return mixed|Property
     */
    public function getPropertyAnnotation($name)
    {
        return $this->propertiesMetadata[$name];
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasPropertyAnnotation($name)
    {
        return isset($this->propertiesMetadata[$name]);
    }
    
    /**
     * @param $name
     * @return array|Blueprint|Property[]
     * @throws \LogicException
     */
    public function __get($name)
    {
        switch ($name) {
            case 'class':
                return $this->getCachedClassMetadata();

            case 'properties':
                return $this->getCachedPropertiesMetadata();
        }
    }

    /**
     * @return Blueprint
     * @throws \LogicException
     */
    private function getCachedClassMetadata()
    {
        if ($this->classMetadata === null) {
            $this->classMetadata = $this->getClassMetadata();
        }

        return $this->classMetadata;
    }

    /**
     * @return array|Property[]
     */
    private function getCachedPropertiesMetadata()
    {
        if ($this->propertiesMetadata === null) {
            $this->propertiesMetadata = $this->getPropertiesMetadata();
        }

        return $this->propertiesMetadata;
    }
}
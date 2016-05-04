<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 03.05.2016 17:30
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Blueprints;

use Doctrine\Common\Annotations\Reader;
use Illuminate\Support\Str;
use Serafim\Blueprint\Mapping\Blueprint;
use Serafim\Blueprint\Mapping\Field;

/**
 * Class Metadata
 * @package Serafim\Blueprint\Blueprints
 */
class Metadata
{
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
    public $class;

    /**
     * @var string
     */
    public $entity;

    /**
     * @var array|Field[]
     */
    public $properties = [];

    /**
     * Metadata constructor.
     * @param string $class
     * @param Reader $reader
     * @param string|null $entity
     * @throws \LogicException
     */
    public function __construct($class, Reader $reader, $entity = null)
    {
        $this->reflection   = new \ReflectionClass($class);
        $this->reader       = $reader;
        $this->entity       = $entity ?: $this->class;

        $this->createClassMetadata();
        $this->createPropertiesMetadata();
    }

    /**
     * @return void
     * @throws \LogicException
     */
    private function createClassMetadata()
    {
        /** @var Blueprint $blueprint */
        $blueprint = $this->reader->getClassAnnotation($this->reflection, Blueprint::class);

        if (!$blueprint) {
            $error = sprintf('Blueprint class %s must be declare a %s class', $this->reflection->name, Blueprint::class);
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


        $this->class = $blueprint;
    }


    /**
     * @return void
     */
    private function createPropertiesMetadata()
    {
        $instance   = $this->reflection->newInstanceWithoutConstructor();
        $properties = $this->reflection->getProperties();

        /** @var \ReflectionProperty $property */
        foreach ($properties as $property) {
            /** @var Field $meta */
            $meta = $this->reader->getPropertyAnnotation($property, Field::class);

            if (!$meta) {
                continue;
            }

            if (!$meta->title) {
                $meta->title = ucfirst((string)$property->name);
            }

            if ($property->isDefault()) {
                if (!$property->isPublic()) {
                    $property->setAccessible(true);
                }
                $meta->value = $property->getValue($instance);
            }

            $this->properties[$property->name] = $meta;
        }
    }

    /**
     * @return Blueprint
     */
    public function getClassMetadata()
    {
        return $this->class;
    }
}
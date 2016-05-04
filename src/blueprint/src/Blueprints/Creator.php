<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 03.05.2016 17:22
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Creator;

/**
 * Class Creator
 * @package Serafim\Blueprint\Creator
 */
class Creator
{
    /**
     * @var object
     */
    private $instance;

    /**
     * @var \ReflectionObject
     */
    private $reflection;

    /**
     * Entity constructor.
     * @param string|object $class
     */
    public function __construct($class)
    {
        if (is_string($class)) {
            $class = (new \ReflectionClass($class))
                ->newInstanceWithoutConstructor();
        }

        $this->instance   = $class;
        $this->reflection = new \ReflectionObject($this->instance);
    }

    /**
     * @param array $fields
     * @return $this
     */
    public function fill(array $fields = [])
    {
        foreach ($fields as $name => $value) {
            $this->fillProperty($name, $value);
        }
        return $this;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return $this
     */
    public function fillProperty($name, $value)
    {
        if (!$this->reflection->hasProperty($name)) {
            $this->instance->{$name} = $value;
            return $this;
        }

        $property = $this->reflection->getProperty($name);

        if (!$property->isPublic()) {
            $property->setAccessible(true);
        }

        $property->setValue($this->instance, $value);

        return $this;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function get($name)
    {
        if ($this->reflection->hasProperty($name)) {
            $property = $this->reflection->getProperty($name);
            if (!$property->isPublic()) {
                $property->setAccessible(true);
            }

            return $property->getValue($this->instance);
        }

        return null;
    }

    /**
     * @return object|string
     */
    public function getObject()
    {
        return $this->instance;
    }
}
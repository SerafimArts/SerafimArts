<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 09.05.2016 23:24
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint;

use Doctrine\Common\Annotations\Reader;

/**
 * Class MetadataManager
 * @package Serafim\Blueprint
 */
class MetadataManager implements \IteratorAggregate
{
    /**
     * @var array|Metadata[]
     */
    private $repository = [];

    /**
     * @var array
     */
    private $routes = [];

    /**
     * @var Reader
     */
    private $reader;

    /**
     * MetadataManager constructor.
     * @param Reader $reader
     */
    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * @return array|Metadata[]
     */
    public function all()
    {
        return $this->repository;
    }

    /**
     * @param $class
     * @return $this
     */
    public function register($class)
    {
        $meta = new Metadata($this->reader, $class);


        $this->repository[$class] = $meta;
        $this->routes[$meta->class->route] = $class;

        return $this;
    }

    /**
     * @param $class
     * @return Metadata
     * @throws \LogicException
     */
    public function get($class)
    {
        if (!isset($this->repository[$class])) {
            $this->register($class);
        }

        return $this->repository[$class];
    }

    /**
     * @param string $name
     * @return Metadata
     * @throws \InvalidArgumentException
     */
    public function getByRoute($name)
    {
        if (!isset($this->routes[$name])) {
            throw new \InvalidArgumentException('Metdata for route "' . $name . '" does not exists');
        }

        return $this->get($this->routes[$name]);
    }

    /**
     * @return array|Metadata[]
     */
    public function getIterator()
    {
        foreach ($this->repository as $item) {
            yield $item;
        }
    }
}
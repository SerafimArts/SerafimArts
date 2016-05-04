<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 03.05.2016 17:43
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Repositories;

use Doctrine\Common\Annotations\Reader;
use Serafim\Blueprint\Blueprints\Metadata;

/**
 * Class BlueprintsMetadataRepository
 * @package Serafim\Blueprint\Repositories
 */
class BlueprintsMetadataRepository implements BlueprintsRepository, \IteratorAggregate
{
    /**
     * @var Reader
     */
    private $reader;

    /**
     * @var array|Metadata[]
     */
    private $classes = [];

    /**
     * @var array
     */
    private $routes = [];

    /**
     * BlueprintsMetadataRepository constructor.
     * @param Reader $reader
     * @param ConfigRepository $repository
     * @throws \LogicException
     */
    public function __construct(Reader $reader, ConfigRepository $repository)
    {
        $this->reader = $reader;

        $items = $repository->get('blueprints.items');
        foreach ($items as $bp => $model) {
            $this->add($bp, $model);
        }
    }

    /**
     * @param string $class
     * @param string|null $relatedEntity
     * @return $this|BlueprintsRepository
     * @throws \LogicException
     */
    public function add($class, $relatedEntity = null)
    {
        $meta = new Metadata($class, $this->reader, $relatedEntity);

        $this->routes[$meta->class->route] = $class;
        $this->classes[$class] = $meta;

        return $this;
    }

    /**
     * @param $class
     * @return Metadata
     * @throws \LogicException
     */
    public function get($class)
    {
        if (!array_key_exists($class, $this->classes)) {
            throw new \LogicException(sprintf('Class %s not defined as blueprint', $class));
        }

        return $this->classes[$class];
    }

    /**
     * @param string $name
     * @return Metadata
     */
    public function getByRoute($name)
    {
        if (!array_key_exists($name, $this->routes)) {
            throw new \LogicException(sprintf('Class %s not defined as blueprint', $name));
        }

        return $this->classes[$this->routes[$name]];
    }


    /**
     * @return $this|\Traversable
     */
    public function all()
    {
        return $this;
    }

    /**
     * @return \Generator
     */
    public function getIterator()
    {
        foreach ($this->classes as $class) {
            yield $class;
        }
    }
}
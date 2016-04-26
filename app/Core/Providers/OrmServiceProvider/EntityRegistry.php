<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 26.04.2016 16:18
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Core\Providers\OrmServiceProvider;

use Analogue\ORM\System\Manager;
use Illuminate\Contracts\Foundation\Application as Container;
use Illuminate\Support\Str;

/**
 * Class EntityRegistry
 * @package Core\Providers\OrmServiceProvider
 */
class EntityRegistry
{
    /**
     * @var Manager
     */
    private $orm;

    /**
     * @var string
     */
    private $entity;

    /**
     * @var Container
     */
    private $container;

    /**
     * EntityRegistry constructor.
     * @param Container $app
     * @param string $entity
     */
    public function __construct(Container $app, string $entity)
    {
        $this->container = $app;
        $this->entity = $entity;
        $this->orm = $app->make(Manager::class);
    }

    /**
     * @param string $mapper
     * @return $this|EntityRegistry
     * @throws \Analogue\ORM\Exceptions\MappingException
     */
    public function mapper(string $mapper) : EntityRegistry
    {
        $this->orm->register($this->entity, $mapper);

        return $this;
    }

    /**
     * @param string $repository
     * @param string|null $interface
     * @return $this|EntityRegistry
     */
    public function repository(string $repository, string $interface = null) : EntityRegistry
    {
        $instance = new $repository($this->entity);

        if ($interface === null) {
            $this->container->singleton($repository, function() use ($instance) {
                return $instance;
            });

            return $this;
        }

        $this->container->singleton($interface, function() use ($instance) {
            return $instance;
        });

        $this->container->alias($interface, $repository);

        return $this;
    }

    /**
     * @param string $observer
     * @return $this|EntityRegistry
     * @throws \Analogue\ORM\Exceptions\MappingException
     */
    public function observe(string $observer) : EntityRegistry
    {
        $instance = $this->container->make($observer);

        $reflection = new \ReflectionClass($observer);
        $methods = $reflection->getMethods(\ReflectionMethod::IS_PUBLIC);

        foreach ($methods as $method) {
            $event = $method->name;

            $invalidName = Str::startsWith($event, '__');

            if ($invalidName || $method->isStatic() || $method->isAbstract()) {
                continue;
            }

            $this->orm->mapper($this->entity)
                ->registerEvent($event, function($entity) use ($event, $instance) {
                    return $this->container->call([$instance, $event], [
                        'entity' => $entity,
                        'name'   => $event
                    ]);
                });
        }

        return $this;
    }
}
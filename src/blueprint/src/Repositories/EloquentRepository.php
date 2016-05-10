<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 10.05.2016 4:49
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\AbstractPaginator;
use Serafim\Blueprint\Factory;
use Serafim\Blueprint\Metadata;

/**
 * Class EloquentRepository
 * @package Serafim\Blueprint\Repositories
 */
class EloquentRepository
{
    /**
     * @var Factory
     */
    private $factory;

    /**
     * EloquentRepository constructor.
     */
    public function __construct()
    {
        $this->factory = new Factory();
    }

    /**
     * @param Metadata $metadata
     * @return mixed
     */
    public function get(Metadata $metadata)
    {
        $query = new $metadata->class->entity;
        $collection = $query->paginate($metadata->class->perPage);

        $setter = function(AbstractPaginator $paginator) use ($metadata) {
            $collection = $paginator->getCollection()
                ->map(function (Model $item) use ($metadata) {
                    return $this->factory->create($metadata->getBlueprint(), $item);
                });

            $reflection = new \ReflectionObject($paginator);
            $property = $reflection->getProperty('items');
            $property->setAccessible(true);
            $property->setValue($paginator, $collection);
        };

        call_user_func($setter, $collection);

        return $collection;

    }
}
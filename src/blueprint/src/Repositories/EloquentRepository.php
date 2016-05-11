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

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use Serafim\Blueprint\Factory;
use Serafim\Blueprint\Mapping\HasOne;
use Serafim\Blueprint\Mapping\Relation;
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
     * @param null|string $orderBy
     * @param string $direction
     * @return Collection|Paginator
     */
    public function get(Metadata $metadata, $orderBy = null, $direction = 'asc')
    {
        $query = $this->getQuery($metadata);

        $query = $this->applyOrder($query, $metadata, $orderBy, $direction);

        return $this->attachPaginator($query, $metadata);
    }


    /**
     * @param Metadata $metadata
     * @return \Eloquent|Builder|Model
     */
    private function getQuery(Metadata $metadata)
    {
        $relations = iterator_to_array($metadata->getRelations());

        /** @var \Eloquent|Model|Builder $query */
        $query = $metadata->class->entity;

        if (count($relations) > 0) {
            $query = $query::with(...array_map(function (Relation $relation) {
                return $relation->name;
            }, $relations));
        } else {
            $query = $query::query();
        }

        return $query;
    }


    /**
     * @param Builder|\Illuminate\Database\Query\Builder $query
     * @param Metadata $metadata
     * @param string $orderBy
     * @param string $dir
     * @return Builder
     * @throws \LogicException
     */
    private function applyOrder(Builder $query, Metadata $metadata, $orderBy, $dir)
    {
        $dir = $dir === 'asc' ? 'asc' : 'desc';

        if ($metadata->hasPropertyAnnotation($orderBy)) {
            $annotation = $metadata->getPropertyAnnotation($orderBy);

            if ($annotation instanceof Relation) {
                if ($annotation instanceof HasOne) {
                    $message = sprintf('Order by %s.%s relation not available yet.', $orderBy, $annotation->field);

                    throw new \LogicException($message);
                }

                throw new \LogicException('Order by relation available only HasOne annotation.');

            } else {

                $query = $query->orderBy($orderBy, $dir);
            }
        }

        return $query;
    }



    /**
     * @param Builder $query
     * @param Metadata $metadata
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    private function attachPaginator(Builder $query, Metadata $metadata)
    {
        $collection = $query->paginate($metadata->class->perPage);

        $setter = function (AbstractPaginator $paginator) use ($metadata) {
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
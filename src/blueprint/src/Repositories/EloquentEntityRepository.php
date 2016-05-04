<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 03.05.2016 20:23
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Serafim\Blueprint\Blueprints\Metadata;
use Serafim\Blueprint\Blueprints\Record;

/**
 * Class EloquentEntityRepository
 * @package Serafim\Blueprint\Repositories
 */
class EloquentEntityRepository implements EntityRepository
{
    /**
     * @var BlueprintsRepository
     */
    private $repo;

    /**
     * EloquentEntityRepository constructor.
     * @param BlueprintsRepository $repository
     */
    public function __construct(BlueprintsRepository $repository)
    {
        $this->repo = $repository;
    }

    /**
     * @param Metadata $metadata
     * @return AbstractPaginator
     */
    public function index(Metadata $metadata)
    {
        /** @var Model $model */
        $model = new $metadata->entity;

        /** @var AbstractPaginator|LengthAwarePaginator $paginator */
        $paginator = $model->paginate($metadata->class->perPage);

        $setter = function(AbstractPaginator $paginator) use ($metadata) {
            $collection = $paginator->getCollection()
                ->map(function (Model $item) use ($metadata) {
                    return new Record($metadata, $item->toArray());
                });

            $reflection = new \ReflectionObject($paginator);
            $property = $reflection->getProperty('items');
            $property->setAccessible(true);
            $property->setValue($paginator, $collection);
        };

        call_user_func($setter, $paginator);

        return $paginator;
    }
}
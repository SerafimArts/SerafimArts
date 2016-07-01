<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Common\Orm;

use Domains\User\User;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ModelRepository
 * @package Common\Orm
 */
abstract class ModelRepository
{
    /**
     * @var string
     */
    private $model;

    /**
     * @var array
     */
    private $relations = [];

    /**
     * ModelRepository constructor.
     * @param string $model
     */
    public function __construct(string $model)
    {
        $this->model = $model;
    }

    /**
     * @param array ...$relations
     * @return $this
     */
    public function with(...$relations)
    {
        $this->relations = array_merge($this->relations, $relations);

        return $this;
    }

    /**
     * @param $id
     * @return Model|null
     */
    public function find($id)
    {
        $class    = $this->model;
        /** @var Model $instance */
        $instance = new $class;

        return $this->findOneBy($instance->getKeyName(), $id);
    }

    /**
     * @param string $column
     * @param null|string $operator
     * @param null|string $value
     * @param string $boolean
     * @return Model|null
     */
    public function findOneBy(string $column, $operator = null, $value = null, $boolean = 'and')
    {
        return $this->createFindByQuery($column, $operator, $value, $boolean)->first();
    }

    /**
     * @param string $column
     * @param null|string $operator
     * @param null|string $value
     * @param string $boolean
     * @return Collection|Model[]
     */
    public function findBy(string $column, $operator = null, $value = null, $boolean = 'and') : Collection
    {
        return $this->createFindByQuery($column, $operator, $value, $boolean)->get();
    }

    /**
     * @param string $column
     * @param null|string $operator
     * @param null|string $value
     * @param string $boolean
     * @return Model|Builder|\Illuminate\Database\Query\Builder
     */
    private function createFindByQuery(string $column, $operator = null, $value = null, $boolean = 'and')
    {
        $result = $this->query()->where($column, $operator, $value, $boolean);

        $this->relations = [];

        return $result;
    }

    /**
     * @return Model|Builder|\Illuminate\Database\Query\Builder
     */
    public function query() : Model
    {
        /** @var Model|Builder|\Illuminate\Database\Query\Builder $class */
        $class = $this->model;

        if (count($this->relations)) {
            return $class::with(...$this->relations);
        } else {
            return new $class;
        }
    }
}
<?php
/**
 * This file is part of BlueprintAdmin package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 03.05.2016 3:50
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Common\Fixtures;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;

/**
 * Class Entity
 * @package Common\Fixtures
 */
class Entity implements Arrayable
{
    /**
     * @var string
     */
    protected $table;

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * Entity constructor.
     * @param string $table
     */
    public function __construct($table)
    {
        $this->table = $table;
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param $name
     * @param array $arguments
     * @return mixed|null
     */
    public function __call($name, array $arguments = [])
    {
        if (strlen($name) > 3) {
            $field = substr($name, 3);

            if (Str::startsWith($name, 'get')) {
                return isset($this->attributes[$field])
                    ? $this->attributes[$field]
                    : null;
            }


            if (Str::startsWith($name, 'set')) {
                $this->attributes[$field] = count($arguments) > 0
                    ? $arguments[0]
                    : null;
            }
        }
    }

    /**
     * @param $field
     * @return mixed|null
     */
    public function __get($field)
    {
        return isset($this->attributes[$field])
            ? $this->attributes[$field]
            : null;
    }

    /**
     * @param $field
     * @param $value
     */
    public function __set($field, $value)
    {
        $this->attributes[$field] = $value;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->attributes;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return array_key_exists('id', $this->attributes)
            ? (string)$this->attributes['id']
            : '0';
    }
}
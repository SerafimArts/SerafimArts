<?php
/**
 * This file is part of BlueprintAdmin package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 03.05.2016 3:40
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Fixtures;

use Illuminate\Database\Connection;
use Illuminate\Database\DatabaseManager;
use Nelmio\Alice\PersisterInterface;

/**
 * Class Persister
 * @package Fixtures
 */
class Persister implements PersisterInterface
{
    /**
     * @var array
     */
    protected $tables = [];

    /**
     * @var array
     */
    protected $items = [];

    /**
     * @var DatabaseManager|Connection
     */
    protected $db;

    /**
     * Persister constructor.
     * @param DatabaseManager $manager
     */
    public function __construct(DatabaseManager $manager)
    {
        $this->db = $manager;
    }

    /**
     * Loads a fixture file
     *
     * @param array[object] $objects instance to persist in the DB
     */
    public function persist(array $objects)
    {
        /**
         * @var string $key
         * @var Entity $object
         */
        foreach ($objects as $key => $object) {
            $table = $object->getTable();

            if (!array_key_exists($table, $this->tables)) {
                $this->tables[$table] = true;
                $this->db->table($table)->truncate();
            }

            $this->items[$key] = $object;

            $this->db->table($table)
                ->insert($object->toArray());
        }
    }

    /**
     * Finds an object by class and id
     *
     * @param  string $class
     * @param  int    $id
     * @return mixed
     */
    public function find($class, $id)
    {
    }
}
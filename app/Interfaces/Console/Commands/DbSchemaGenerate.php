<?php
/**
 * This file is part of SerafimArts package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Interfaces\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

/**
 * Class DbSchemaGenerate
 * @package Interfaces\Console\Commands
 */
class DbSchemaGenerate extends Command
{
    /**
     * @var string
     */
    protected $signature = 'db:generate:schema';

    /**
     * @var string
     */
    protected $description = 'Generate schema';

    /**
     * @var Connection
     */
    private $db;

    /**
     * @return void
     */
    public function handle(Repository $config, Connection $connection)
    {
        $this->db = $connection;

        $excluded = $config->get('database.generator.schema.skip', []);

        $tables = array_filter($this->getTables(), function($item) use ($excluded) {
            return !in_array($item, $excluded, true);
        });

        $output = $config->get('database.generator.schema.output', base_path('database/schema'));

        if (!@mkdir($output, 0777, true) && !is_dir($output)) {
            throw new \InvalidArgumentException('Can not create output directory');
        }


        foreach ($tables as $table) {
            $path = $output . '/' . $table . '.xml';

            $model = new \SimpleXMLElement('<model></model>', LIBXML_NOBLANKS);
            $model->addAttribute('table', str_replace($connection->getTablePrefix(), '', $table));

            $modelName = $table;
            switch (true) {
                case Str::endsWith($table, 'ies'):
                    $modelName = substr($table, 0, -3) . 'y';
                    break;
                case Str::endsWith($table, 's'):
                    $modelName = substr($table, 0, -1);
                    break;
            }

            $model->addAttribute('model', Str::studly($modelName));

            foreach ($this->getColumns($table) as $column => $type) {
                $field = $model->addChild('column', $column);

                $field->addAttribute('type', $type);
            }

            $model->saveXML($path);

            $this->info('Schema generated to ' . realpath($path));
        }
    }

    /**
     * @return array
     */
    private function getTables()
    {
        switch ($this->db->getDriverName()) {
            case 'sqlite':
                $query = <<<EOF
                    SELECT name FROM sqlite_master WHERE type IN ('table','view') 
                        AND name NOT LIKE 'sqlite_%'
                        UNION ALL
                            SELECT name FROM sqlite_temp_master 
                                WHERE type IN ('table','view') ORDER BY 1
EOF;
                return array_map(function($result) {
                    return $result->name;
                }, $this->db->select($query));
        }

        return [];
    }

    /**
     * @param string $table
     * @return \Generator
     */
    private function getColumns(string $table) : \Generator
    {
        switch ($this->db->getDriverName()) {
            case 'sqlite':
                // Prepare statements for query does not works correctly
                foreach ($this->db->select('PRAGMA table_info(' . $table . ')') as $result) {
                    yield $result->name => $this->resolveType($result->type);
                }
        }
        return [];
    }

    /**
     * @param string $type
     * @return string
     */
    private function resolveType(string $type) : string
    {
        $type = strtolower($type);

        switch (true) {
            case $type === 'varchar':
            case Str::startsWith($type, 'varchar'):
            case $type === 'text':
                return 'string';

            case 'integer':
                return 'int';
        }

        throw new \InvalidArgumentException('Can not resolve type ' . $type);
    }
}
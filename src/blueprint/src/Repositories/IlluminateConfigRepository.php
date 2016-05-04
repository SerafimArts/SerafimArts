<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 03.05.2016 19:43
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Repositories;

use Illuminate\Contracts\Config\Repository;

/**
 * Class IlluminateConfigRepository
 * @package Serafim\Blueprint\Repositories
 */
class IlluminateConfigRepository implements ConfigRepository
{
    /**
     * @var Repository
     */
    private $repo;

    /**
     * IlluminateConfigRepository constructor.
     * @param Repository $config
     */
    public function __construct(Repository $config)
    {
        $this->repo = $config;
    }

    /**
     * @param string $name
     * @param null $default
     * @return mixed
     */
    public function get($name, $default = null)
    {
        return $this->repo->get('blueprint.' . $name, $default);
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->repo->get('blueprint');
    }
}
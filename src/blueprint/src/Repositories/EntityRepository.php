<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 03.05.2016 20:22
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Repositories;

use Illuminate\Pagination\AbstractPaginator;
use Serafim\Blueprint\Blueprints\Metadata;

/**
 * Interface EntityRepository
 * @package Serafim\Blueprint\Repositories
 */
interface EntityRepository
{
    /**
     * @return AbstractPaginator
     */
    public function index(Metadata $metadata);
}
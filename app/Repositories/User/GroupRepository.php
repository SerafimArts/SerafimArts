<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 26.04.2016 16:48
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Repositories\User;
use Illuminate\Support\Collection;

/**
 * Interface GroupRepository
 * @package Repositories\User
 */
interface GroupRepository
{
    /**
     * @return Collection
     */
    public function all();
}

<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 26.04.2016 17:13
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Observers;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
 * Class IdObserver
 * @package Observers
 */
class IdObserver
{
    /**
     * @param Model $entity
     */
    public function creating(Model $entity)
    {
        $primaryKey = $entity->getKeyName();

        if (!$entity->getAttribute($primaryKey)) {
            $entity->setAttribute($primaryKey, Uuid::uuid4()->toString());
        }
    }
}
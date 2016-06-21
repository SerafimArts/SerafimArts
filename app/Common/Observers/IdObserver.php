<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Common\Observers;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
 * Class IdObserver
 * @package Common\Observers
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
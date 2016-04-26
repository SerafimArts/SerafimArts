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

use Ramsey\Uuid\Uuid;
use Analogue\ORM\Entity;
use Analogue\ORM\System\Manager;

/**
 * Class IdObserver
 * @package Observers
 */
class IdObserver
{
    /**
     * @var Manager
     */
    private $manager;

    /**
     * IdObserver constructor.
     * @param Manager $manager
     */
    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param Entity $entity
     * @throws \Analogue\ORM\Exceptions\MappingException
     */
    public function creating(Entity $entity)
    {
        $primaryKey = $this->manager
            ->mapper(get_class($entity))
            ->getEntityMap()
            ->getKeyName();

        if (!$entity->getEntityAttribute($primaryKey)) {
            $entity->setEntityAttribute($primaryKey, Uuid::uuid4()->toString());
        }
    }
}
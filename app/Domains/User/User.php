<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\User;

use Ramsey\Uuid\Uuid;
use Common\Orm\Mapping as ORM;
use Common\Observers\IdObserver;
use Domains\User\Base\AbstractUser;
use PhpDeal\Annotation as Contract;
use Domains\User\Repository\EloquentUserRepository;

/**
 * @uses IdObserver
 * @uses EloquentUserRepository
 *
 * @ORM\Observe(IdObserver::class)
 * @ORM\Repository(class=EloquentUserRepository::class)
 *
 * @Contract\Invariant("is_uuid($this->id)")
 */
class User extends AbstractUser implements AdminAuthorizable
{
    /**
     * @var array
     */
    protected $fillable = ['id'];

    /**
     * User constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct(
            array_merge($attributes, [
                'id' => $attributes['id'] ?? Uuid::uuid4()->toString()
            ])
        );
    }

    /**
     * @return bool
     */
    public function isAdmin() : bool
    {
        return $this->group->id === Group::GROUP_ADMIN;
    }
}
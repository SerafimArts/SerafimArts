<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 05.04.2016 13:55
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\User;

use Analogue\ORM\Entity;
use Carbon\Carbon;

/**
 * Class User
 * @package Domains\User
 *
 * @property-read string $id
 * @property-read string $name
 * @property-read string $email
 * @property-read string $password
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 */
class User extends Entity
{
    /**
     * User constructor.
     * @param string $name
     * @param string $email
     * @param string $password
     */
    public function __construct(string $name, string $email, string $password)
    {
        $this->attributes['name'] = $name;
        $this->attributes['email'] = $email;
        $this->attributes['password'] = \Hash::make($password);
        $this->attributes['group_id'] = Group::GROUP_USER;
    }

    /**
     * @param Group $group
     * @return $this|User
     */
    public function setGroup(Group $group) : User
    {
        $this->attributes['group_id'] = $group->id;

        return $this;
    }
}
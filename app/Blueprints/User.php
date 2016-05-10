<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 03.05.2016 7:44
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Blueprints;

use Serafim\Blueprint\Mapping as UI;
use Domains\User\User as UserEntity;

/**
 * @UI\Blueprint(entity=UserEntity::class, title="Пользователи", icon="user", perPage=15)
 */
class User
{
    /**
     * @var string
     * @UI\Text(title="Имя", sortable=true)
     */
    protected $name;

    /**
     * @var string
     * @UI\Text(title="Email", sortable=true)
     */
    protected $email;

    /**
     * @var string
     * @UI\Image(title="Аватар", width=48, height=48)
     */
    protected $avatar;

    /**
     * @var string
     * @UI\Text(title="Дата создания", sortable=true)
     */
    protected $created_at;

    /**
     * @var string
     * @UI\Text(title="Дата обновления", sortable=true)
     */
    protected $updated_at;
}
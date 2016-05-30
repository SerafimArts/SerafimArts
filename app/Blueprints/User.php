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

/**
 * @UI\Blueprint(title="Пользователи", icon="supervisor_account")
 */
class User
{
    /**
     * @var string
     * @UI\PrimaryKey
     */
    protected $id;

    /**
     * @var string
     * @UI\Image(title="Аватар", width=32, height=32)
     */
    protected $avatar;

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
     * @UI\DateTime(title="Создан", sortable=true)
     */
    protected $created_at;

    /**
     * @var string
     * @UI\DateTime(title="Обновлён", sortable=true)
     */
    protected $updated_at;
}
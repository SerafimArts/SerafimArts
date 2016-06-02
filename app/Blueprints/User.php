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

use Illuminate\Database\Eloquent\Model;
use Serafim\Blueprint\Mapping as Entity;
use Serafim\BlueprintAdmin\Mapping as Ui;

/**
 * @Entity\PrimaryKey(name="id")
 * @Entity\Blueprint(title="Пользователи", icon="supervisor_account")
 */
class User extends Model
{
    /**
     * @var string
     * @Ui\Image(title="Аватар", width=32, height=32, uploadPath="/img/uploads")
     */
    protected $avatar;

    /**
     * @var string
     * @Ui\Text(title="Имя", sortable=true)
     */
    protected $name;

    /**
     * @var string
     * @Ui\Text(title="Email", sortable=true)
     */
    protected $email;

    /**
     * @var string
     * @Ui\DateTime(title="Создан", sortable=true)
     */
    protected $created_at;

    /**
     * @var string
     * @Ui\DateTime(title="Обновлён", sortable=true)
     */
    protected $updated_at;
}
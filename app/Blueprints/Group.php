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
 * @UI\Blueprint(title="Группы пользователей", icon="lock")
 */
class Group
{
    /**
     * @var string
     * @UI\Text(sortable=true, write=false)
     * @UI\PrimaryKey
     */
    protected $id;

    /**
     * @var string
     * @UI\Text(title="Название группы", sortable=true)
     */
    protected $title;
}
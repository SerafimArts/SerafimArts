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

use Serafim\Blueprint\Mapping as Entity;
use Serafim\BlueprintAdmin\Mapping as Ui;

/**
 * @Entity\Blueprint(title="Группы пользователей", icon="lock")
 */
class Group
{
    /**
     * @var string
     * @Ui\Text(sortable=true, write=false)
     * @Entity\PrimaryKey
     */
    protected $id;

    /**
     * @var string
     * @Ui\Text(title="Название группы", sortable=true)
     */
    protected $title;
}
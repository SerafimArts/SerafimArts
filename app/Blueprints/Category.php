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
 * @UI\Blueprint(title="Категории", icon="label_outline")
 */
class Category
{
    /**
     * @var string
     * @UI\PrimaryKey
     */
    protected $id;
    
    /**
     * @var string
     * @UI\Text(title="Название", sortable=true)
     */
    protected $title;

    /**
     * @var string
     * @UI\Text(title="Описание", sortable=true)
     */
    protected $description;
    
    /**
     * @var string
     * @UI\DateTime(title="Создана", sortable=true)
     */
    protected $created_at;

    /**
     * @var string
     * @UI\DateTime(title="Обновлена", sortable=true)
     */
    protected $updated_at;
}
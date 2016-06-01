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
 * @Entity\Blueprint(title="Категории", icon="label_outline")
 */
class Category
{
    /**
     * @var string
     * @Entity\PrimaryKey
     */
    protected $id;
    
    /**
     * @var string
     * @Ui\Text(title="Название", sortable=true)
     */
    protected $title;

    /**
     * @var string
     * @Ui\Text(title="Описание", sortable=true)
     */
    protected $description;
    
    /**
     * @var string
     * @Ui\DateTime(title="Создана", sortable=true)
     */
    protected $created_at;

    /**
     * @var string
     * @Ui\DateTime(title="Обновлена", sortable=true)
     */
    protected $updated_at;
}
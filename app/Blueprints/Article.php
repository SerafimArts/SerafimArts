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
 * @Entity\Blueprint(title="Записи", icon="description")
 */
class Article extends Model
{
    /**
     * @var string
     * @Ui\Text(title="Тип", sortable=true)
     */
    protected $type;

    /**
     * @var string
     * @Ui\Text(title="Название", sortable=true)
     */
    protected $title;

    /**
     * @var string
     * @Ui\Text(title="Адрес", sortable=true)
     */
    protected $url;

    /**
     * @var string
     * @Ui\Text(title="Краткое содержание", length=50)
     */
    protected $preview;

    /**
     * @var string
     * @Ui\Boolean(title="Публикуется", sortable=true, inverse=true)
     */
    protected $is_draft;

    /**
     * @var string
     * @Ui\DateTime(title="Публикация", sortable=true)
     */
    protected $publish_at;
    
    /**
     * @var string
     * @Ui\DateTime(title="Создано", sortable=true)
     */
    protected $created_at;

    /**
     * @var string
     * @Ui\DateTime(title="Обновлено", sortable=true)
     */
    protected $updated_at;
}
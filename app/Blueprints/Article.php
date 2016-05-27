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
 * @UI\Blueprint(title="Записи", icon="description")
 */
class Article
{
    /**
     * @var string
     * @UI\PrimaryKey
     */
    protected $id;

    /**
     * @var string
     * @UI\Text(title="Тип", sortable=true)
     */
    protected $type;

    /**
     * @var string
     * @UI\Text(title="Название", sortable=true)
     */
    protected $title;

    /**
     * @var string
     * @UI\Text(title="Адрес", sortable=true)
     */
    protected $url;

    /**
     * @var string
     * @UI\HasOne(title="Автор", field="name", route="user")
     */
    protected $user;

    /**
     * @var string
     * @UI\Text(title="Краткое содержание", length=50)
     */
    protected $preview;

    /**
     * @var string
     * @UI\Boolean(title="Публикуется", sortable=true, inverse=true)
     */
    protected $is_draft;

    /**
     * @var string
     * @UI\DateTime(title="Публикация", sortable=true)
     */
    protected $publish_at;
    
    /**
     * @var string
     * @UI\DateTime(title="Создано", sortable=true)
     */
    protected $created_at;

    /**
     * @var string
     * @UI\DateTime(title="Обновлено", sortable=true)
     */
    protected $updated_at;
}
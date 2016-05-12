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

use Carbon\Carbon;
use Serafim\Blueprint\Mapping as UI;
use Domains\Article\Article as ArticleEntity;

/**
 * @UI\Blueprint(entity=ArticleEntity::class, title="Записи", icon="description")
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
     * @UI\Text(title="Адрес", readDecorator="urlDecorator", sortable=true)
     */
    protected $url;

    /**
     * @var string
     * @UI\HasOne(title="Автор", field="name", route="user")
     */
    protected $user;

    /**
     * @var string
     * @UI\Text(title="Краткое содержание", maxSize=50)
     */
    protected $preview;

    /**
     * @var string
     * @UI\Boolean(title="Публикуется", sortable=true, inverse=true)
     */
    protected $is_draft;

    /**
     * @var string
     * @UI\DateTime(title="Публикация", readDecorator="dateFormat", sortable=true, width=150)
     */
    protected $publish_at;
    
    /**
     * @var string
     * @UI\DateTime(title="Создано", readDecorator="dateFormat", sortable=true, width=150)
     */
    protected $created_at;

    /**
     * @var string
     * @UI\DateTime(title="Обновлено", readDecorator="dateFormat", sortable=true, width=150)
     */
    protected $updated_at;


    /**
     * @param string $url
     * @return string
     */
    protected function urlDecorator($url)
    {
        return '/' . $url;
    }

    /**
     * @param string $date
     * @return string
     */
    private function dateFormat($date)
    {
        $locale = Carbon::getLocale();

        Carbon::setLocale(app('config')->get('app.locale'));

        $result = (new Carbon($date))->diffForHumans();

        Carbon::setLocale($locale);

        return $result;
    }
}
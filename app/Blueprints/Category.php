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
use Domains\Article\Category as CategoryEntity;

/**
 * @UI\Blueprint(entity=CategoryEntity::class, title="Категории", icon="label_outline")
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
     * @UI\DateTime(title="Создана", readDecorator="dateFormat", sortable=true, width=150)
     */
    protected $created_at;

    /**
     * @var string
     * @UI\DateTime(title="Обновлена", readDecorator="dateFormat", sortable=true, width=150)
     */
    protected $updated_at;


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
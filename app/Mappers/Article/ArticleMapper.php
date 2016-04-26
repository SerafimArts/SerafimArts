<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 26.04.2016 15:58
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Mappers\Article;

use Analogue\ORM\EntityMap;

/**
 * Class ArticleMapper
 * @package Mappers\Article
 */
class ArticleMapper extends EntityMap
{
    /**
     * @var string
     */
    protected $table = 'articles';

    /**
     * @var bool
     */
    public $timestamps = true;
}
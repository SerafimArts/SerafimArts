<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 26.04.2016 15:56
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Article;

use Domains\User\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package Domains\Article
 */
class Category extends Model
{
    /**
     * @var string
     */
    protected $table = 'categories';
}
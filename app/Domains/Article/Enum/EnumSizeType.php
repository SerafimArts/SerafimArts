<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 18.06.2016 07:08
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Article\Enum;

use MyCLabs\Enum\Enum as BaseEnum;

/**
 * Class EnumSizeType
 * @package Domains\Article\Enum
 * 
 * @Annotation
 */
class EnumSizeType extends BaseEnum
{
    const Narrow    = '1';
    const Normal    = '2';
    const Wide      = '3';
}
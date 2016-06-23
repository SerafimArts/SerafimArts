<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Article\Enum;

use MabeEnum\Enum as BaseEnum;

/**
 * Class EnumSizeType
 * @package Domains\Article\Enum
 * 
 * @Annotation
 */
class EnumSizeType extends BaseEnum
{
    const NARROW    = '1';
    const NORMAL    = '2';
    const WIDE      = '3';
}
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
 * Class EnumArticleType
 * @package Domains\Article\Enum
 * 
 * @Annotation
 */
final class EnumArticleType extends BaseEnum
{
    const VIDEO  = 'Video';
    const TEXT   = 'Text';
    const HTML   = 'Html';
    const PLANK  = 'Plank';
}
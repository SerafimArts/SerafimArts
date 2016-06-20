<?php
/**
 * This file is part of SerafimArts package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Article\Enum;

use MyCLabs\Enum\Enum as BaseEnum;

/**
 * Class EnumArticleType
 * @package Domains\Article\Enum
 * 
 * @Annotation
 */
final class EnumArticleType extends BaseEnum
{
    const Video  = 'Video';
    const Text   = 'Text';
    const Html   = 'Html';
    const Plank  = 'Plank';
}
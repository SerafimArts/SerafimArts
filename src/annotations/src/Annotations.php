<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 03.05.2016 20:00
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Annotations;

use Illuminate\Support\Facades\Facade;

/**
 * Class Annotations
 * @package Serafim\Annotations
 */
class Annotations extends Facade
{
    /**
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return AnnotationsServiceProvider::CONTAINER_KEY;
    }
}
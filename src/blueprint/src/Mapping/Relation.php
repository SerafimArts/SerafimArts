<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 03.05.2016 23:33
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Mapping;

/**
 * Class Relation
 * @package Serafim\Blueprint\Mapping
 */
abstract class Relation extends Field
{
    /**
     * @var string
     */
    public $field = 'id';
}
<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 03.05.2016 7:53
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Mapping;

use Doctrine\Common\Annotations\Annotation\Target;
use Illuminate\Contracts\View\View;

/**
 * Class Property
 * @package Serafim\Blueprint\Mapping
 * @Annotation
 * @Target("PROPERTY")
 */
abstract class Property
{
    /**
     * @var mixed
     */
    public $title = null;

    /**
     * @var bool
     */
    public $read = true;

    /**
     * @var bool
     */
    public $write = true;

    /**
     * @var bool
     */
    public $sortable = false;

    /**
     * @var mixed
     */
    public $name = null;

    /**
     * Default value of property
     * @var mixed
     */
    public $value = null;

    /**
     * @var mixed
     */
    public $readDecorator = null;

    /**
     * @var mixed
     */
    public $writeDecorator = null;

    /**
     * @var int
     */
    public $width = 0;

    /**
     * @return View
     */
    public function read()
    {
        return view('bp::field.text.read');
    }

    /**
     * @return View
     */
    public function write()
    {
        return view('bp::field.text.write');
    }
}
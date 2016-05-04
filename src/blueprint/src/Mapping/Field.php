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
 * Class Field
 * @package Serafim\Blueprint\Mapping
 * @Annotation
 * @Target("PROPERTY")
 */
abstract class Field
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
     * @var mixed
     */
    public $before = null;

    /**
     * @var mixed
     */
    public $after = null;

    /**
     * @var bool
     */
    public $sortable = false;

    /**
     * @var mixed
     */
    public $value = null;

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
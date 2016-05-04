<?php
/**
 * This file is part of BlueprintAdmin package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 02.05.2016 21:29
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Mapping;

use Doctrine\Common\Annotations\Annotation\Target;
use Illuminate\Contracts\View\View;

/**
 * Class Text
 * @package Serafim\Blueprint\Mapping
 * @Annotation
 * @Target("PROPERTY")
 */
class Image extends Field
{
    /**
     * @var int
     */
    public $width = 32;

    /**
     * @var int
     */
    public $height = 32;

    /**
     * @return View
     */
    public function read()
    {
        return view('bp::field.image.read');
    }

    /**
     * @return View
     */
    public function write()
    {
        return view('bp::field.image.write');
    }
}
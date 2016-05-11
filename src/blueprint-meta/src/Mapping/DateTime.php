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
 * Class DateTime
 * @package Serafim\Blueprint\Mapping
 * @Annotation
 * @Target("PROPERTY")
 */
class DateTime extends Property
{
    /**
     * @return View
     */
    public function read()
    {
        return view('bp::field.datetime.read');
    }

    /**
     * @return View
     */
    public function write()
    {
        return view('bp::field.datetime.write');
    }
}
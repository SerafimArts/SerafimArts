<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 12.05.2016 2:17
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Mapping;

use Doctrine\Common\Annotations\Annotation\Target;
use Illuminate\Contracts\View\View;

/**
 * Class HasOne
 * @package Serafim\Blueprint\Mapping
 * @Annotation
 * @Target("PROPERTY")
 */
class HasOne extends Relation
{
    /**
     * @var string
     */
    public $orderBy = 'id';

    /**
     * @return View
     */
    public function read()
    {
        return view('bp::field.has-one.read');
    }

    /**
     * @return View
     */
    public function write()
    {
        return view('bp::field.has-one.write');
    }
}
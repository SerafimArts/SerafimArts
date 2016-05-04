<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 03.05.2016 19:09
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Controllers;

use Illuminate\Contracts\View\View;
use Serafim\Blueprint\Blueprints\Metadata;
use Serafim\Blueprint\Repositories\EntityRepository;

/**
 * Class CrudController
 * @package Serafim\Blueprint\Controllers
 */
class CrudController extends Controller
{
    /**
     * @param Metadata $metadata
     * @param EntityRepository $entities
     * @return View
     */
    public function index(Metadata $metadata, EntityRepository $entities)
    {
        $items = $entities->index($metadata);
        
        return view('bp::crud.index', [
            'items' => $items,
            'meta'  => $metadata
        ]);
    }
}
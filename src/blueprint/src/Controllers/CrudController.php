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
use Serafim\Blueprint\Metadata;
use Serafim\Blueprint\Presenter;
use Serafim\Blueprint\Repositories\EloquentRepository;

/**
 * Class CrudController
 * @package Serafim\Blueprint\Controllers
 */
class CrudController extends Controller
{
    /**
     * @param Metadata $metadata
     * @return View
     */
    public function index(Metadata $metadata, EloquentRepository $repository)
    {
        $repo = new EloquentRepository();
        $items = $repo->get($metadata);

        return view('bp::crud.index', [
            'data' => new Presenter($metadata, $items),
        ]);
    }
}
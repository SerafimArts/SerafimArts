<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 03.05.2016 7:00
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Controllers;

use Illuminate\View\View;

/**
 * Class DashboardController
 * @package Serafim\Blueprint\Controllers
 */
class DashboardController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        return view('bp::page.dashboard');
    }
}
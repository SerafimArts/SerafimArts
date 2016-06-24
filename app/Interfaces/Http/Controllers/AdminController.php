<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Interfaces\Http\Controllers;

use Illuminate\View\View;

/**
 * Class AdminController
 * @package Interfaces\Http\Controllers
 */
class AdminController extends Controller
{
    /**
     * @return View
     */
    public function dashboard()
    {
        $view = view('admin.dashboard', [
            
        ]);

        return \AdminSection::view($view, 'Dashboard');
    }
}
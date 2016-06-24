<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Interfaces\Http\Controllers;

use Carbon\Carbon;
use Domains\Analytic\Repository\AnalyticRepository;
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
    public function dashboard(AnalyticRepository $repository)
    {
        $view = view('admin.dashboard', [
            'unique' => (object)[
                'day'   => $repository->getUniqueUsersPerPeriod(Carbon::now()->subDay()),
                'month' => $repository->getUniqueUsersPerPeriod(Carbon::now()->subMonth())
            ],
            'visits' => (object)[
                'day'   => $repository->getUsersPerPeriod(Carbon::now()->subDay()),
                'month' => $repository->getUsersPerPeriod(Carbon::now()->subMonth())
            ],
            'stats' => (object)[
                'month' => $repository
                    ->getUserDailyStatsPerPeriod(Carbon::now()->subMonth())
                    ->toArray()
            ]
        ]);

        return \AdminSection::view($view, 'Dashboard');
    }
}
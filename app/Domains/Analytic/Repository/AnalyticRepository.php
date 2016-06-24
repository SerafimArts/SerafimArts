<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Analytic\Repository;

use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * Interface AnalyticRepository
 * @package Domains\Analytic\Repository
 */
interface AnalyticRepository
{
    /**
     * @param Carbon $from
     * @param Carbon|null $to
     * @return Collection
     */
    public function getUniqueUsersPerPeriod(Carbon $from, Carbon $to = null) : Collection;

    /**
     * @param Carbon $from
     * @param Carbon|null $to
     * @return Collection
     */
    public function getUsersPerPeriod(Carbon $from, Carbon $to = null) : Collection;

    /**
     * @param Carbon $from
     * @param \Closure $step
     * @param Carbon|null $to
     * @return Collection
     */
    public function getUserStatsPerPeriod(Carbon $from, \Closure $step, Carbon $to = null) : Collection;
}
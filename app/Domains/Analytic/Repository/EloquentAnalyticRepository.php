<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Analytic\Repository;

use Carbon\Carbon;
use Domains\Analytic\Analytic;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

/**
 * Class EloquentAnalyticRepository
 * @package Domains\Analytic\Repository
 */
class EloquentAnalyticRepository implements AnalyticRepository
{
    /**
     * @param Carbon $from
     * @param Carbon|null $to
     * @return Collection|Analytic[]
     */
    public function getUniqueUsersPerPeriod(Carbon $from, Carbon $to = null) : Collection
    {
        $to = $to ?: Carbon::now();

        return (new Analytic)
            ->where('created_at', '>=', $from)
            ->where('created_at', '<=', $to)
            ->orderBy('created_at')
            ->groupBy('identity')
            ->get();
    }


    /**
     * @param Carbon $from
     * @param Carbon|null $to
     * @return Collection|Analytic[]
     */
    public function getUsersPerPeriod(Carbon $from, Carbon $to = null) : Collection
    {
        $to = $to ?: Carbon::now();

        return (new Analytic)
            ->where('created_at', '>=', $from)
            ->where('created_at', '<=', $to)
            ->get();
    }

    /**
     * @param Carbon $from
     * @param \Closure $step
     * @param Carbon|null $to
     * @return Collection
     */
    public function getUserStatsPerPeriod(Carbon $from, \Closure $step, Carbon $to = null) : Collection
    {
        $to = $to ?: Carbon::now();
        $result = new Collection();

        if ($to <= $from) {
            return $result;
        }

        $i = 0;
        while (($current = $step($from)) < $to && ++$i) {
            /** @var Carbon $fromCurrentTo */
            $fromCurrentTo = $step(Carbon::parse($current));

            $result->push([
                'x' => $fromCurrentTo,
                'y' => $this->getUsersPerPeriod($current, $fromCurrentTo)->count()
            ]);
        }

        return $result;
    }

}
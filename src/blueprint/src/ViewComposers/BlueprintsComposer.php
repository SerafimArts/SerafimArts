<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 03.05.2016 17:51
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\ViewComposers;

use Illuminate\View\View;
use Serafim\Blueprint\Repositories\BlueprintsRepository;

/**
 * Class BlueprintsComposer
 * @package Serafim\Blueprint\ViewComposers
 */
class BlueprintsComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        /** @var BlueprintsRepository $repository */
        $repository = app(BlueprintsRepository::class);

        $view->with('bp', $repository);
    }
}
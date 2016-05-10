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

use Illuminate\Contracts\Container\Container;
use Illuminate\View\View;
use Serafim\Blueprint\MetadataManager;

/**
 * Class BlueprintsComposer
 * @package Serafim\Blueprint\ViewComposers
 */
class BlueprintsComposer
{
    /**
     * @var Container
     */
    private $app;

    /**
     * BlueprintsComposer constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->app = $container;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $repo = $this->app->make(MetadataManager::class);

        $view->with('bp', $repo);
    }
}
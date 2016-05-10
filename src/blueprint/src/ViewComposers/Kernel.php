<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 10.05.2016 3:17
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\ViewComposers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\Factory;

/**
 * Class Kernel
 * @package Serafim\Blueprint\ViewComposers
 */
class Kernel
{
    /**
     * @var array
     */
    private $composers = [
        ConfigComposer::class     => ['bp::partials.*', 'bp::layout.master', 'bp::page.*'],
        BlueprintsComposer::class => 'bp::partials.aside',
    ];

    /**
     * Kernel constructor.
     * @param Factory $views
     */
    public function __construct(Factory $views)
    {
        foreach ($this->composers as $composer => $viewNames) {
            $views->composer($viewNames, $composer);
        }
    }
}
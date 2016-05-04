<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 03.05.2016 7:07
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\ViewComposers;

use Illuminate\Contracts\View\View;
use Serafim\Blueprint\Repositories\ConfigRepository;

/**
 * Class ConfigComposer
 * @package Serafim\Blueprint\ViewComposers
 */
class ConfigComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        /** @var ConfigRepository $config */
        $config = app(ConfigRepository::class);

        foreach ($config->all() as $key => $value) {
            $view->with($key, $value);
        }

    }
}
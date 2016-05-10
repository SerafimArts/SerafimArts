<?php
/**
 * This file is part of BlueprintAdmin package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 02.05.2016 21:27
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Serafim\Blueprint\Mapping;

use Illuminate\Contracts\View\View;

/**
 * Interface Presenter
 * @package Serafim\Blueprint\Mapping
 */
interface Presenter
{
    /**
     * @return View
     */
    public function edit();

    /**
     * @return View
     */
    public function show();
}

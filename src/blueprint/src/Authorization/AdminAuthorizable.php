<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 03.05.2016 6:24
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Authorization;

/**
 * Interface AdminAuthorizable
 * @package Serafim\Blueprint\Authorization
 */
interface AdminAuthorizable
{
    /**
     * @return bool
     */
    public function isAdmin();
}
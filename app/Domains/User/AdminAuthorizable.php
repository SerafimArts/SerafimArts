<?php
/**
 * This file is part of SerafimArts package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\User;

/**
 * Interface AdminAuthorizable
 * @package Domains\User
 */
interface AdminAuthorizable
{
    /**
     * @return bool
     */
    public function isAdmin() : bool;
}
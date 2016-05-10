<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 10.05.2016 3:24
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Authorization;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;

/**
 * Class Kernel
 * @package Serafim\Blueprint\Authorization
 */
class Kernel
{
    const GATE_AUTH_NAME = 'bp.auth';

    /**
     * Kernel constructor.
     * @param GateContract $gate
     */
    public function __construct(GateContract $gate)
    {
        $gate->define(static::GATE_AUTH_NAME, function (AdminAuthorizable $user) {
            return $user->isAdmin();
        });
    }
}
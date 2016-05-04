<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 26.04.2016 17:13
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Providers;

use Domains\User\Group;
use Domains\User\User;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Policies\UserPolicy;

/**
 * Class AuthServiceProvider
 * @package Providers
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param Repository $config
     * @param GateContract $gate
     * @return void
     */
    public function boot(GateContract $gate, Repository $config)
    {
        $this->registerPolicies($gate);
    }
}

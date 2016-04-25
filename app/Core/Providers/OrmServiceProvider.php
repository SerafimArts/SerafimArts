<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 05.04.2016 23:54
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Core\Providers;

use Analogue\ORM\Plugins\Timestamps\TimestampsPlugin;
use Analogue\ORM\System\Manager;
use Illuminate\Support\ServiceProvider;

/**
 * Class OrmServiceProvider
 * @package Core\Providers
 */
class OrmServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->alias('analogue', 'orm');
        $this->app->alias('analogue', Manager::class);

        /** @var Manager $orm */
        $orm = $this->app->make(Manager::class);

        $orm->registerPlugin(TimestampsPlugin::class);
    }

    public function boot()
    {
        //
    }
}
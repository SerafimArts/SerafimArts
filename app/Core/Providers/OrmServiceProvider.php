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

use Analogue\ORM\Exceptions\MappingException;
use Analogue\ORM\Plugins\Timestamps\TimestampsPlugin;
use Analogue\ORM\System\Manager;
use Core\Providers\OrmServiceProvider\EntityRegistry;
use Domains\Article\Article;
use Domains\User\Group;
use Domains\User\User;
use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;
use Mappers\Article\ArticleMapper;
use Mappers\User\GroupMapper;
use Mappers\User\UserMapper;
use Observers\IdObserver;
use Repositories\Article\AnalogueArticleRepository;
use Repositories\Article\ArticleRepository;
use Repositories\User\AnalogueGroupRepository;
use Repositories\User\AnalogueUserRepository;
use Repositories\User\GroupRepository;
use Repositories\User\UserRepository;

/**
 * Class OrmServiceProvider
 * @package Core\Providers
 */
class OrmServiceProvider extends ServiceProvider
{
    /**
     * @var array|EntityRegistry[]
     */
    private $entities = [];

    /**
     * @throws \Analogue\ORM\Exceptions\MappingException
     * @throws \InvalidArgumentException
     * @return void
     */
    public function register()
    {
        $this->app->alias('analogue', 'orm');
        $this->app->alias('analogue', Manager::class);

        $this->registerPlugins($this->app->make(Manager::class));

        $this->registerEntities();
    }

    /**
     * @return $this
     * @throws MappingException
     */
    protected function registerEntities()
    {
        $this->entity(User::class)->mapper(UserMapper::class)
            ->repository(AnalogueUserRepository::class, UserRepository::class)
            ->observe(IdObserver::class);

        $this->entity(Article::class)->mapper(ArticleMapper::class)
            ->repository(AnalogueArticleRepository::class, ArticleRepository::class)
            ->observe(IdObserver::class);

        $this->entity(Group::class)->mapper(GroupMapper::class)
            ->repository(AnalogueGroupRepository::class, GroupRepository::class)
            ->observe(IdObserver::class);

        return $this;
    }

    /**
     * @param Manager $manager
     * @return $this
     */
    protected function registerPlugins(Manager $manager)
    {
        $manager->registerPlugin(TimestampsPlugin::class);

        return $this;
    }

    /**
     * @param string $name
     * @return EntityRegistry
     */
    protected function entity(string $name) : EntityRegistry
    {
        if (!array_key_exists($name, $this->entities)) {
            $this->entities[$name] = new EntityRegistry($this->app, $name);
        }

        return $this->entities[$name];
    }
}
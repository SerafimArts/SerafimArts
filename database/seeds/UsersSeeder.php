<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 26.04.2016 17:10
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Analogue\ORM\Mappable;
use Analogue\ORM\System\Manager;
use Analogue\ORM\System\Mapper;
use Domains\User\Group;
use Domains\User\User;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Mappers\User\UserMapper;
use Repositories\User\AnalogueGroupRepository;
use Repositories\User\GroupRepository;

/**
 * Class UserSeeder
 */
class UserSeeder extends Seeder
{
    /**
     * @throws \Analogue\ORM\Exceptions\MappingException
     * @return void
     */
    public function run()
    {
        /** @var Mapper $orm */
        $orm = $this->container->make(Manager::class)->mapper(User::class);

        /** @var Generator $faker */
        $faker = Factory::create('ru_RU');

        /** @var UserMapper $mapper */
        $mapper = $this->container->make(UserMapper::class);

        /** @var Group[]|Collection $groups */
        $groups = $this->container->make(GroupRepository::class)->all();

        /** @var Group $admin */
        $admin = $groups->where('id', Group::GROUP_ADMIN)->first();



        \DB::table($mapper->getTable())->truncate();


        $user = new User('Serafim', 'nesk@xakep.ru', '');
        $user->setEntityAttribute('password', '$2y$10$tTFAcfZQZPGPrVYtrz9dJeT0nvrJY5Hz12HUHhSqZUpftjDbeZAFO');
        $user->setGroup($admin);
        $orm->store($user);

        foreach (range(0, 99) as $i) {
            $orm->store(new User($faker->firstName, $faker->email, 'password'));
        }
    }
}
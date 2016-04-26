<?php
use Analogue\ORM\System\Manager;
use Domains\User\Group;
use Illuminate\Database\Seeder;
use Mappers\User\GroupMapper;
use Repositories\User\AnalogueGroupRepository;
use Repositories\User\GroupRepository;

/**
 * This file is part of serafimarts.ru package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 26.04.2016 16:50
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class GroupsSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        $orm = $this->container->make(Manager::class)->mapper(Group::class);
        /** @var GroupMapper $mapper */
        $mapper = $this->container->make(GroupMapper::class);

        \DB::table($mapper->getTable())->truncate();

        foreach ($this->getGroups() as $uuid => $title) {
            $group = new Group($title);
            $group->setEntityAttribute('id', $uuid);

            $orm->store($group);
        }
    }

    /**
     * @return array
     */
    private function getGroups()
    {
        return [
            Group::GROUP_USER  => 'Пользователь',
            Group::GROUP_ADMIN => 'Администратор',
        ];
    }
}
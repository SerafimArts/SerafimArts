<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Admin\Pages;

use Domains\User\Group;
use SleepingOwl\Admin\Model\ModelConfiguration;

/**
 * Class UserPage
 * @package Admin\Pages
 */
class UserPage implements Page
{
    /**
     * ArticlePage constructor.
     * @param ModelConfiguration $model
     */
    public function __construct(ModelConfiguration $model)
    {
        $model
            ->setTitle('Пользователи')
            ->onDisplay(function () {
                return \AdminDisplay::table()
                    ->setColumns(
                        \AdminColumn::image('avatar', 'Аватар'),
                        \AdminColumn::relatedLink('group.title', 'Группа'),
                        \AdminColumn::text('name', 'Имя')->setWidth('100px'),
                        \AdminColumn::text('email', 'Почта'),
                        \AdminColumn::datetime('created_at', 'Зарегистрирован'),
                        \AdminColumn::datetime('updated_at', 'Активность')
                    )
                    ->with('group')
                    ->paginate(15)
                ;
            })
            ->onCreateAndEdit(function () {
                return \AdminForm::panel()
                    ->addBody(
                        \AdminFormElement::image('avatar', 'Аватар'),
                        \AdminFormElement::select('group_id', 'Группа', Group::class)
                            ->setDisplay('title'),
                        \AdminFormElement::text('name', 'Имя'),
                        \AdminFormElement::text('email', 'Почта'),
                        \AdminFormElement::time('created_at', 'Зарегистрирован'),
                        \AdminFormElement::time('updated_at', 'Активность')
                    );
            })
        ;
    }
}
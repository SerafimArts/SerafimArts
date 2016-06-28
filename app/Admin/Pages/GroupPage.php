<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Admin\Pages;

use SleepingOwl\Admin\Model\ModelConfiguration;

/**
 * Class GroupPage
 * @package Admin\Pages
 */
class GroupPage implements Page
{
    /**
     * ArticlePage constructor.
     * @param ModelConfiguration $model
     */
    public function __construct(ModelConfiguration $model)
    {
        $model
            ->setTitle('Группы пользователей')
            ->onDisplay(function () {
                return \AdminDisplay::table()
                    ->setColumns(
                        \AdminColumn::text('id', 'Идентификатор'),
                        \AdminColumn::text('title', 'Группа')
                    )
                    ->paginate(15)
                    ;
            })
            ->onCreate(function () {
                return \AdminForm::panel()
                    ->addBody(
                        \AdminFormElement::text('title', 'Название группы')
                    );
            })
            ->onEdit(function () {
                return \AdminForm::panel()
                    ->addBody(
                        \AdminFormElement::text('id', 'ID группы'),
                        \AdminFormElement::text('title', 'Название группы')
                            ->required()
                    );
            })
        ;
    }
}
<?php
/**
 * This file is part of SerafimArts package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Admin\Pages;

use AdminDisplay;
use AdminColumn;
use SleepingOwl\Admin\Model\ModelConfiguration;

/**
 * Class CategoryPage
 * @package Admin\Pages
 */
class CategoryPage implements Page
{
    /**
     * ArticlePage constructor.
     * @param ModelConfiguration $model
     */
    public function __construct(ModelConfiguration $model)
    {
        $model
            ->setTitle('Категории')
            ->onDisplay(function () {
                return AdminDisplay::table()
                    ->setColumns(
                        AdminColumn::text('title', 'Заголовок')->setWidth('300px'),
                        AdminColumn::text('description', 'Описание')
                    )
                    ->paginate(15)
                ;
            })
            ->onCreateAndEdit(function () {
                return \AdminForm::panel()
                    ->addBody(
                        \AdminFormElement::text('title', 'Заголовок'),
                        \AdminFormElement::text('description', 'Описание'),
                        \AdminFormElement::time('created_at', 'Дата создани'),
                        \AdminFormElement::time('updated_at', 'Дата обновления')
                    )
                ;
            })
        ;
    }
}
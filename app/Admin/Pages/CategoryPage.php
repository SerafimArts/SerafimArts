<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Admin\Pages;

use AdminDisplay;
use AdminColumn;
use Domains\Article\Category;
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
                        AdminColumn::text('color', 'Цвет категории')
                    )
                    ->paginate(15)
                ;
            })
            ->onCreateAndEdit(function () {
                return \AdminForm::panel()
                    ->addBody(
                        \AdminFormElement::select('parent_id', 'Родитель', Category::class)
                            ->setDisplay('title'),
                        \AdminFormElement::text('title', 'Заголовок')
                            ->required(),
                        \AdminFormElement::text('color', 'Цвет категории')
                    )
                ;
            })
        ;
    }
}
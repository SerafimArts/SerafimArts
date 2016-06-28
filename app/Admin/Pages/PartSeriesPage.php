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
 * Class PartSeriesPage
 * @package Admin\Pages
 */
class PartSeriesPage implements Page
{
    /**
     * ArticlePage constructor.
     * @param ModelConfiguration $model
     */
    public function __construct(ModelConfiguration $model)
    {
        $model
            ->setTitle('Серия статей')
            ->onDisplay(function() {
                return \AdminDisplay::table()
                    ->setColumns(
                        \AdminColumn::text('title', 'Заголовок')->setWidth('200px')
                    )
                    ->paginate(15);
            })
            ->onCreateAndEdit(function () {
                return \AdminForm::panel()
                    ->addBody(
                        \AdminFormElement::text('title', 'Заголовок')
                            ->required()
                    )
                ;
            });
    }
}
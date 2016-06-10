<?php
/**
 * This file is part of SerafimArts package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Admin\Pages;

use Carbon\Carbon;
use Domains\Article\Category;
use Domains\User\User;
use SleepingOwl\Admin\Model\ModelConfiguration;

/**
 * Class ArticlePage
 * @package Admin\Pages
 */
class ArticlePage implements Page
{
    /**
     * ArticlePage constructor.
     * @param ModelConfiguration $model
     */
    public function __construct(ModelConfiguration $model)
    {
        $model
            ->setTitle('Записи')
            ->onDisplay(function() {
                return \AdminDisplay::table()
                    ->setColumns(
                        \AdminColumn::relatedLink('category.title', 'Категория'),
                        \AdminColumn::text('title', 'Заголовок')->setWidth('200px'),
                        \AdminColumn::text('preview', 'Краткое описание'),
                        \AdminColumn::relatedLink('user.name', 'Автор')
                    )
                    ->with('user', 'category')
                    ->paginate(15);
            })
            ->onCreateAndEdit(function ($d) {
                return \AdminForm::panel()
                    ->addHeader(
                        \AdminFormElement::time('publish_at', 'Дата публикации')
                            ->setDefaultValue(Carbon::now())
                    )
                    ->addBody(
                        \AdminFormElement::select('category.id', 'Категория', Category::class)
                            ->setDisplay('title')
                            ->required(),
                        \AdminFormElement::select('user.id', 'Автор', User::class)
                            ->setDisplay('name')
                            ->setDefaultValue(\Auth::user()),

                        \AdminFormElement::checkbox('is_draft', 'Это черновик')
                            ->setDefaultValue(true),

                        \AdminFormElement::text('title', 'Заголовок'),
                        \AdminFormElement::text('url', 'URL Адрес'),

                        \AdminFormElement::textarea('content', 'Содержание'),
                        \AdminFormElement::textarea('preview', 'Краткое описание')->setRows(3),

                        \AdminFormElement::time('created_at', 'Дата создания'),
                        \AdminFormElement::time('updated_at', 'Дата обновления')
                    )
                ;
            });
    }
}
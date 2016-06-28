<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Admin\Pages;

use Domains\Article\Article;
use Domains\Article\PartSeries;
use SleepingOwl\Admin\Model\ModelConfiguration;

/**
 * Class PartsPage
 * @package Admin\Pages
 */
class PartsPage implements Page
{
    /**
     * ArticlePage constructor.
     * @param ModelConfiguration $model
     */
    public function __construct(ModelConfiguration $model)
    {
        $model
            ->setTitle('Главы серий')
            ->onDisplay(function() {
                return \AdminDisplay::table()
                    ->setColumns(
                        \AdminColumn::relatedLink('series.title', 'Серия')->setWidth('200px'),
                        \AdminColumn::relatedLink('article.title', 'Статья')->setWidth('200px'),
                        \AdminColumn::text('part', 'Глава')
                    )
                    ->with('series', 'article')
                    ->paginate(15);
            })
            ->onCreateAndEdit(function () {
                return \AdminForm::panel()
                    ->addBody(
                        \AdminFormElement::select('series_id', 'Серия', PartSeries::class)
                            ->setDisplay('title')
                            ->required(),
                        \AdminFormElement::select('article_id', 'Статья', Article::class)
                            ->setDisplay('title')
                            ->required(),
                        \AdminFormElement::text('part', 'Глава №')
                    )
                ;
            });
    }
}
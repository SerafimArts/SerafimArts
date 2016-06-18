<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 18.06.2016 12:17
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Article\Repository;

use Domains\Article\Article;
use Illuminate\Support\Collection;
use Domains\Article\MainPageArticle;

/**
 * Class EloquentArticleRepository
 * @package Domains\Article\Repository
 */
class EloquentArticleRepository implements ArticleRepository
{
    /**
     * @param int|null $count
     * @return Collection|Article[]
     */
    public function getPublished(int $count = null) : Collection
    {
        $query = (new Article)->published();
        if ($count) {
            $query = $query->take($count);
        }
        return $query->get();
    }

    /**
     * @return Collection|MainPageArticle
     */
    public function getPreviews() : Collection
    {
        /** @var MainPageArticle $query */
        $query = MainPageArticle::query();

        return $query->orderBy('order_id', 'asc')->get();
    }

    /**
     * @param string $url
     * @return Article|null
     */
    public function getByUrl(string $url)
    {
        return (new Article)->published()
            ->where('url', $url)->first();
    }
}
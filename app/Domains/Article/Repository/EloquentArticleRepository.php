<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Article\Repository;

use Domains\Article\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use PhpDeal\Annotation as Contract;
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
     * 
     * @Contract\Verify("$count === null || $count > 0")
     */
    public function getPublished(int $count = null) : Collection
    {
        $query = Article::query()->published();
        if ($count) {
            $query = $query->take($count);
        }
        /** @var Builder $query */
        return $query->get();
    }

    /**
     * @return Collection|MainPageArticle
     */
    public function getPreviews() : Collection
    {
        /** @var MainPageArticle $query */
        $query = MainPageArticle::with('relation.category');
        
        /** @var Builder|\Illuminate\Database\Query\Builder $query */
        return $query->orderBy('order_id', 'asc')->get();
    }

    /**
     * @param string $url
     * @return Article|null
     *
     * @Contract\Verify("strlen($url) > 0 && strlen($url) <= 255")
     */
    public function getByUrl(string $url)
    {
        return (new Article)
            ->with('category', 'part')
            ->published()
            ->where('url', 'LIKE', $url)->first();
    }
}
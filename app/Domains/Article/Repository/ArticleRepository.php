<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Article\Repository;

use Domains\Article\Article;
use Domains\Article\MainPageArticle;
use Illuminate\Support\Collection;

/**
 * Interface ArticleRepository
 * @package Domains\Article\Repository
 */
interface ArticleRepository
{
    /**
     * @param int|null $count
     * @return Collection|Article[]
     */
    public function getPublished(int $count = null) : Collection;

    /**
     * @param string $url
     * @return Article|null
     */
    public function getByUrl(string $url);

    /**
     * @return Collection|MainPageArticle[]
     */
    public function getPreviews() : Collection;
}
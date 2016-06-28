<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Article\Observers;

use cebe\markdown\GithubMarkdown;
use Domains\Article\Article;

/**
 * Class UrlGeneratorObserver
 * @package Domains\Article\Observers
 */
class UrlGeneratorObserver
{
    /**
     * @param Article $article
     */
    public function saving(Article $article)
    {
        if (!$article->url) {
            $article->url = str_slug($article->title);
            if ($article->part) {
                $article->url .= '-part-' . $article->part->part;
            }
        }
    }
}
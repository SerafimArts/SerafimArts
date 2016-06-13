<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 13.06.2016 03:46
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Observers;

use cebe\markdown\GithubMarkdown;
use Domains\Article\Article;

/**
 * Class ContentRenderObserver
 * @package Observers
 */
class ContentRenderObserver
{
    /**
     * @var GithubMarkdown
     */
    private $md;

    /**
     * ContentRenderObserver constructor.
     * @param GithubMarkdown $md
     */
    public function __construct(GithubMarkdown $md)
    {
        $this->md = $md;
    }

    /**
     * @param string $content
     * @return string
     */
    private function parse(string $content)
    {
        return $this->md->parse($content);
    }

    /**
     * @param Article $article
     */
    public function saving(Article $article)
    {
        $article->setAttribute('content_rendered', $this->parse((string)$article->content));
        $article->setAttribute('preview_rendered', $this->parse((string)$article->preview));
    }
}
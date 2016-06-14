<?php
/**
 * This file is part of SerafimArts package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Interfaces\Http\Controllers;

use Domains\Article\Article;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ArticleController
 * @package Interfaces\Http\Controllers
 */
class ArticleController extends Controller
{
    /**
     * @param $url
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws NotFoundHttpException
     */
    public function show($url)
    {
        $article = Article::where('url', $url)->first();

        if (!$article) {
            throw new NotFoundHttpException;
        }

        return view('pages.article.show', ['article' => $article]);
    }
}
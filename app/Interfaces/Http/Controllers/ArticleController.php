<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Interfaces\Http\Controllers;

use PhpDeal\Annotation as Contract;
use Domains\Article\Repository\ArticleRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ArticleController
 * @package Interfaces\Http\Controllers
 */
class ArticleController extends Controller
{
    /**
     * @param ArticleRepository $repository
     * @param $url
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws NotFoundHttpException
     *
     * @Contract\Verify("is_string($url) && strlen($url) > 0")
     */
    public function show(ArticleRepository $repository, $url)
    {
        $article = $repository->getByUrl($url);

        if ($article) {
            return view('pages.article.show', ['article' => $article]);
        }

        throw new NotFoundHttpException;
    }
}
<?php
namespace Interfaces\Http\Controllers;


use Domains\Article\Article;
use Domains\Article\MainPageArticle;
use Domains\Article\Repository\ArticleRepository;

/**
 * Class HomeController
 * @package Interfaces\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @param ArticleRepository $repository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ArticleRepository $repository)
    {
        return view('pages.index', [
            'previews' => $repository->getPreviews(),
            'articles' => $repository->getPublished(15)
        ]);
    }
}
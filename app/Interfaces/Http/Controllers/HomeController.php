<?php
namespace Interfaces\Http\Controllers;


use Domains\Article\Article;
use Domains\Article\MainPageArticle;

/**
 * Class HomeController
 * @package Interfaces\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('pages.index', [
            'previews' => MainPageArticle::orderBy('order_id', 'asc')->get(),
            'articles' => (new Article)->published()->get()
        ]);
    }
}
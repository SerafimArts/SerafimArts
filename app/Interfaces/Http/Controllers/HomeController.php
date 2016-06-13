<?php
namespace Interfaces\Http\Controllers;

use Domains\Article\Article;

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
            'articles' => Article::with('user')
                ->published()
                ->onMainPage()
                ->take(10)->get()
        ]);
    }
}
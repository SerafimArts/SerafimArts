<?php
namespace Interfaces\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }
}
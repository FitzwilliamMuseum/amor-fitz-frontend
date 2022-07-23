<?php

namespace App\Http\Controllers;


use App\Models\Pages;
use App\Models\Items;
use Illuminate\Contracts\View\View;

class aboutController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $data = Pages::find(1);
        return view('pages.about', compact('data'));
    }

    /**
     * @return View
     */
    public function home(): View
    {
        $page = Pages::find(5);
        return view('pages.welcome', compact('page'));
    }

    /**
     * @return View
     */
    public function acknowledgements(): View
    {
        $data = Pages::find(2);
        return view('pages.acknowledgements', compact('data'));
    }
    /**
     * @return View
     */
    public function team(): View
    {
        $data = Items::findByType(array('item_type' => 'team'));
        return view('pages.team', compact('data'));
    }
    /**
     * @return View
     */
    public function userGuide(): View
    {
        $data = Pages::find(6);
        return view('pages.user-guide', compact('data'));
    }
}

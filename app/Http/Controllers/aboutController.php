<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pages;
use App\Models\Entities;
use App\Models\Items;

class aboutController extends Controller
{
  public function index()
  {
    $data = Pages::find(1);
    return view('pages.about', compact('data'));
  }

  public function home()
  {
    $page = Pages::find(5);
    return view('pages.welcome', compact('page'));
  }
  public function acknowledgements()
  {
    $data = Pages::find(2);
    return view('pages.acknowledgements', compact('data'));
  }

  public function team()
  {
    $data = Items::findByType(array('item_type' => 'team'));
    return view('pages.team', compact('data'));
  }

  public function userGuide()
  {
    $data = Pages::find(6);
    return view('pages.user-guide', compact('data'));
  }
}

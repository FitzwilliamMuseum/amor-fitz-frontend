<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Pages;
use App\Models\Entities;
use App\Models\Items;
use App\Models\Relations;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class entitiesController extends Controller
{
    public function index()
    {
      $page    = Pages::find(3);
      $places  = Entities::findEntities(array('name' => 'place'));
      $people  = Entities::findEntities(array('name' => 'person'));
      $letters = Entities::findEntities(array('name' => 'letter'));
      $texts   = Entities::findEntities(array('name' => 'text'));
      $events  = Entities::findEntities(array('name' => 'event'));
      $family  = Entities::findEntities(array('name' => 'family'));
      return view('entities.index', compact('places', 'people', 'letters', 'texts', 'events','family', 'page'));
    }

    public function entity(string $slug, Request $request)
    {
      $perPage = 12;
      $from = ($request->get('page', 1) - 1) * $perPage;
      $overview  = Entities::findEntities(array('name' => $slug));
      $items = Items::findByType(array('item_type' => $slug, 'per_page' => $perPage, 'page' => $request->get('page', 1) ));
      $paginate = new LengthAwarePaginator($items, $overview[0]['items']['count'], 12);
      $paginate->setPath($request->getBaseUrl());
      return view('entities.entity', compact('overview','items', 'paginate'));
    }

    public function details(int $id)
    {
      $data = Items::find($id)[0];
      return view('entities.details', compact('data'));
    }
}

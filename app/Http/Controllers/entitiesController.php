<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Pages;
use App\Models\Entities;
use App\Models\Items;
use Illuminate\Pagination\LengthAwarePaginator;

class entitiesController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
      $page    = Pages::find(3);
      $places  = Entities::findEntities(array('name' => 'place'));
      $people  = Entities::findEntities(array('name' => 'person'));
      $texts   = Entities::findEntities(array('name' => 'text'));
      $events  = Entities::findEntities(array('name' => 'event'));
      $family  = Entities::findEntities(array('name' => 'family'));
      return view('entities.index', compact('places', 'people',  'texts', 'events','family', 'page'));
    }

    /**
     * @param string $slug
     * @param Request $request
     * @return Application|Factory|View
     */
    public function entity(string $slug, Request $request): Application|Factory|View
    {
      $perPage = 12;
      ($request->get('page', 1) - 1) * $perPage;
      $overview  = Entities::findEntities(array('name' => $slug));
      $items = Items::findByType(array('item_type' => $slug, 'per_page' => $perPage, 'page' => $request->get('page', 1) ));
      $paginate = new LengthAwarePaginator($items, $overview[0]['items']['count'], 12);
      $paginate->setPath($request->getBaseUrl());
      return view('entities.entity', compact('overview','items', 'paginate'));
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function details(int $id): Application|Factory|View
    {
      $data = Items::find($id);
      return view('entities.details', compact('data'));
    }
}

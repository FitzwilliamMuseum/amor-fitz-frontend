<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OmekaApi;
use App\Hypothesis;

use Illuminate\Support\Facades\Http;
use App\Models\Pages;
use App\Models\Items;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class correspondencesController extends Controller
{
    public function index(Request $request)
    {
      $perPage = 4;
      $args =  array(
        // 'hasImage' => 1,
        'per_page' => $perPage,
        'page' => $request->get('page', 1),
        'item_type' => 'Letter'
      );
      $records = Items::findByType($args);
      $page = Pages::find(4);
      $counts = Items::counts(array('name' => 'Letter'));
      $paginate = new LengthAwarePaginator($records, $counts[0]['items']['count'], 4);
      $paginate->setPath($request->getBaseUrl());
      return view('correspondences.index', compact('records', 'page', 'paginate'));
    }

    public function getImages($url){
      $response = Http::get($url);
      $data = $response->json();
      return $data;
    }

    public function letter($id){
      $annotations = Hypothesis::read($id);
      $data = Items::letter($id);
      return view('correspondences.letter', compact('data', 'annotations'));
    }
}

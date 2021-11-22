<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OmekaApi;
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
        'per_page' => $perPage, 'page' => $request->get('page', 1)
      );
      $records = Items::findByType($args);
      $page = Pages::find(4);
      $paginate = new LengthAwarePaginator($records, 249, 12);
      $paginate->setPath($request->getBaseUrl());
      return view('correspondences.index', compact('records', 'page', 'paginate'));
    }

    public function getImages($url){
      $response = Http::get($url);
      $data = $response->json();
      return $data;
    }

    public function letter($id){

      $data = Items::find($id);
      return view('correspondences.letter', compact('data'));
    }
}

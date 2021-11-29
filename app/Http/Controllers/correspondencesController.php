<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OmekaApi;
use App\Hypothesis;

use Illuminate\Support\Facades\Http;
use App\Models\Pages;
use App\Models\Items;
use App\Models\Tags;
use App\Models\Correspondences;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class correspondencesController extends Controller
{
    public function index(Request $request)
    {
      $args = array('item_type' => 'Letter');
      $convos = Correspondences::find($args);
      $perPage = 4;
      $args =  array(
        'hasImage' => 1,
        'per_page' => $perPage,
        'page' => $request->get('page', 1),
        'item_type' => 'Letter'
      );
      $records = Items::findByType($args);
      $page = Pages::find(4);
      $counts = Items::counts(array('item_type' => 'Letter'));
      $paginate = new LengthAwarePaginator($records, count($counts), 4);
      $paginate->setPath($request->getBaseUrl());
      return view('correspondences.index', compact('convos', 'records', 'page', 'paginate'));
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

    public function tag(Request $request)
    {
      $args = array('item_type' => 'Letter', 'tags' => request()->segment(3));
      $convos = Correspondences::find($args);
      $perPage = 4;
      $args =  array(
        'hasImage' => 1,
        'per_page' => $perPage,
        'page' => $request->get('page', 1),
        'item_type' => 'Letter',
      );
      $countArgs = array('item_type' => 'Letter');
      if(!is_null(request()->segment(3))){
        $params = Tags::findByTags(request()->segment(3));
        $args['tags'] = implode(',', $params);
        $countArgs['tags'] = implode(',', $params);
      }
      $records = Items::findByType($args);
      $page = Pages::find(4);
      $counts = Items::counts($countArgs);
      $paginate = new LengthAwarePaginator($records, count($counts), 4);
      $paginate->setPath($request->getBaseUrl());
      $tag = Tags::findByTags(request()->segment(3));
      // dd($tag);
      return view('correspondences.tag', compact('convos', 'records', 'page', 'paginate', 'tag'));
    }
}

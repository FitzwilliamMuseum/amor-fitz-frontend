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
use App\OmekaApi;

class mapsController extends Controller
{
    public function placesGeoJson()
    {
        $places = new OmekaApi;
        $places->setEndpoint('items');
        $places->setArguments(
          array(
            'item_type' => 'Place'
          )
        );
        $items = $places->getData();
        $features = array();
        $records = array();
        foreach($items as $item){
          foreach($item['element_texts'] as $element){
            $record[$element['element']['name']] = htmlentities($element['text']);
          }
          $record['id'] = $item['id'];
          $records[] = $record;
        }
        foreach ($records as $record) {
          $data = array(
            'type' => 'Feature',
            'geometry' => array(
              'type' => 'Point',
              'coordinates' => array(
                 floatval($record['Longitude']),
                 floatval($record['Latitude'])
               ),
              'properties' =>  array(
                'title' => $record['Title'],
                'description' => $record['Description'],
                'url' => route('entity.detail', $record['id'])
              )
            ));

          $features[] = $data;
        }
        $geojson = array(
          "type" => "FeatureCollection",
          "features" => $features
        );
        return response()->json($geojson);
    }
}

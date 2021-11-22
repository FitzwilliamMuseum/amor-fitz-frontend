<?php

namespace App\Models;

use App\OmekaApi;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class Relations
{
  public static function find(int $id)
  {
    $api = new OmekaApi;
    $api->setEndpoint('items');
    $api->setid($id);
    return $api->getData();
  }

  public static function expand(array $items){
    $data = array();
    foreach($items['element_texts'] as $element){
      $data[$element['element']['name']] = str_replace(array("\r", "\n"), ' ', $element['text']);
    }
    $data['id'] = $items['id'];
    $data['created'] = $items['added'];
    $data['modified'] = $items['modified'];
    $data['type'] = $items['item_type']['name'];
    if(array_key_exists('url', $items['files'])){
      $response = Http::get($items['files']['url']);
      $data['images'] = $response->json();
    }
    if(array_key_exists('itemrelations', $items['extended_resources'])){
      $response = Http::get('http://hayleypapers.fitzmuseum.cam.ac.uk/api/itemrelations/?object_item_id=' . $items['id']);
      $data['relations'] = $response->json();
    }
    return $data;
  }
}

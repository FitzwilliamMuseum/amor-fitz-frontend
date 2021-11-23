<?php

namespace App\Models;

use App\OmekaApi;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class Items
{
  public static function findByType(array $args)
  {
    $api = new OmekaApi;
    $api->setEndpoint('items');
    $api->setArguments(
      $args
    );
    return self::letterExpand($api->getData());
  }

  public static function find(int $id)
  {
    $api = new OmekaApi;
    $api->setEndpoint('items');
    $api->setid($id);
    return self::expander(array($api->getData()));
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
      $response = new OmekaApi;
      $response->setEndpoint('itemrelations')->setArguments(array('object_item_id' => $items['id']));
      $data['relations'] = $response->getData();
    }
    return $data;
  }

  public static function expander(array $items){
    $records = array();
    foreach($items as $item) {
      foreach($item['element_texts'] as $element){
        $data[$element['element']['name']] = str_replace(array("\r", "\n"), ' ', $element['text']);
      }
      $data['id'] = $item['id'];
      $data['created'] = $item['added'];
      $data['modified'] = $item['modified'];
      $data['type'] = $item['item_type']['name'];
      if(array_key_exists('url', $item['files'])){
        $response = Http::get($item['files']['url']);
        $data['images'] = $response->json();
      }
      // dd($item);
      if(array_key_exists('itemrelations', $item['extended_resources'])){
        $response = new OmekaApi;
        $response->setEndpoint('itemrelations');
        $response->setArguments(array('object_item_id' => $item['id']));
        // Http::get('http://hayleypapers.fitzmuseum.cam.ac.uk/api/itemrelations/?object_item_id=' . $items['id']);
        $data['relations'] = $response->getData();
        $data['expanded'] = array();
        if(!empty($data['relations'])){
          if(array_key_exists(0,$data['relations'])){
            foreach($data['relations'] as $relation){
              if(isset($relation['object_item_url'])){
                $object = $relation['object_item_url'];
                $response = Http::get($object);
              }
              $expanded = array();
              foreach($response['element_texts'] as $element){
                $expanded[$element['element']['name']] = str_replace(array("\r", "\n"), ' ', $element['text']);
              }
              if (isset($relation['subject_item_url'])){
                $subject = $relation['subject_item_url'];
                $responses = Http::get($subject);
                $refs = array();
                $refs['id'] = $responses['id'];
                foreach($responses['element_texts'] as $element){
                  $refs[$element['element']['name']] = str_replace(array("\r", "\n"), ' ', $element['text']);
                }
                $expanded['refs'] = $refs;
              }
              $expanded['property_label'] = $relation['property_label'];
              $expanded['object_item_id'] = $relation['object_item_id'];
              $expanded['entityType'] = $response['item_type']['name'];
              $data['expanded'][] = $expanded;

            }
          }
        }
      }
      $records[] = $data;
    }
    return $records;
  }


  public static function letter(int $id)
  {
    $api = new OmekaApi;
    $api->setEndpoint('items');
    $api->setid($id);
    return self::letterExpand(array($api->getData()));
  }


  public static function letterExpand(array $items){
    $records = array();
    foreach($items as $item) {
      foreach($item['element_texts'] as $element){
        $data[$element['element']['name']] = str_replace(array("\r", "\n"), ' ', $element['text']);
      }
      $data['id'] = $item['id'];
      $data['created'] = $item['added'];
      $data['modified'] = $item['modified'];
      $data['type'] = $item['item_type']['name'];
      if(array_key_exists('url', $item['files'])){
        $response = Http::get($item['files']['url']);
        $data['images'] = $response->json();
      }
      if(array_key_exists('itemrelations', $item['extended_resources'])){
        $response = Http::get($item['extended_resources']['itemrelations']['url']);
        $data['relations'] = $response->json();
        $data['expanded'] = array();
        if(!empty($data['relations'])){
          if(array_key_exists(0,$data['relations'])){
            foreach($data['relations'] as $relation){
              if(isset($relation['object_item_url'])){
                $resource = $relation['object_item_url'];
              } else {
                $resource = $relation['subject_item_url'];
              }
              $response = Http::get($resource);
              $expanded = array();
              foreach($response['element_texts'] as $element){
                $expanded[$element['element']['name']] = str_replace(array("\r", "\n"), ' ', $element['text']);
              }
              $expanded['property_label'] = $relation['property_label'];
              $expanded['object_item_id'] = $relation['object_item_id'];
              $expanded['entityType'] = $response['item_type']['name'];
              $data['expanded'][] = $expanded;
            }
          }
        }
      }
      $records[] = $data;
    }
    return $records;
  }
}

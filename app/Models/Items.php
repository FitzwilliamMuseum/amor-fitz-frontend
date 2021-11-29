<?php

namespace App\Models;

use App\OmekaApi;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class Items
{

  public static function getTags()
  {
    $api = new OmekaApi;
    $api->setEndpoint('tags');
    return $api->getData();
  }

  public static function counts(array $args)
  {
    $api = new OmekaApi;
    $api->setEndpoint('items');
    if(array_key_exists('tags', $args)){
      $tagList = self::getTags();
      foreach($tagList as $key => $rep)
        {
            if (in_array($args['tags'], $rep)) {
                $args['tags'] = $rep['name'];
            }
        }
    }
    $api->setArguments(
      $args
    );
    return $api->getData();
  }
  public static function findByType(array $args)
  {
    $api = new OmekaApi;
    $api->setEndpoint('items');
    if(array_key_exists('tags', $args)){
      $tagList = self::getTags();
      foreach($tagList as $key => $rep)
        {
            if (in_array($args['tags'], $rep)) {
                $args['tags'] = $rep['name'];
            }
        }
    }
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
      $images = new OmekaApi;
      // $response = Http::get($items['files']['url']);
      $data['images'] = $images->getUrl($items['files']['url']);
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
        $images = new OmekaApi;
        $data['images'] = $images->getUrl($item['files']['url']);
      }
      if(array_key_exists('itemrelations', $item['extended_resources'])){
        $response = new OmekaApi;
        $response->setEndpoint('itemrelations');
        $response->setArguments(array('object_item_id' => $item['id']));
        $data['relations'] = $response->getData();
        $data['expanded'] = array();
        if(!empty($data['relations'])){
          if(array_key_exists(0,$data['relations'])){
            foreach($data['relations'] as $relation){
              if(isset($relation['object_item_url'])){
                $object = $relation['object_item_url'];
                $objects = new OmekaApi;
                $response = $images->getUrl($object);
              }
              $expanded = array();
              foreach($response['element_texts'] as $element){
                $expanded[$element['element']['name']] = str_replace(array("\r", "\n"), ' ', $element['text']);
              }
              if (isset($relation['subject_item_url'])){
                $subject = $relation['subject_item_url'];
                $subjects = new OmekaApi;
                $responses = $subjects->getUrl($subject);
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

  public static function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ($arr as $key => $row) {
        $sort_col[$key] = $row[$col];
    }
    array_multisort($sort_col, $dir, $arr);
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
      $data['tags'] = $item['tags'];

      if(array_key_exists('url', $item['files'])){
        $image = new OmekaApi;
        $images = $image->getUrl($item['files']['url']);
        self::array_sort_by_column($images, 'order');
        $data['images'] = $images;
      }
      if(array_key_exists('itemrelations', $item['extended_resources'])){
        $relations = new OmekaApi;
        $data['relations'] = $relations->getUrl($item['extended_resources']['itemrelations']['url']);
        $data['expanded'] = array();
        if(!empty($data['relations'])){
          if(array_key_exists(0,$data['relations'])){
            foreach($data['relations'] as $relation){
              if(isset($relation['object_item_url'])){
                $resource = $relation['object_item_url'];
              } else {
                $resource = $relation['subject_item_url'];
              }
              $call =  new OmekaApi;
              $response = $call->getUrl($resource);
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

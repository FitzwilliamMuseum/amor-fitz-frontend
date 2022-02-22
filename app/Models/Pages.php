<?php

namespace App\Models;

use App\OmekaApi;

class Pages
{
  public static function find(int $id)
  {
    $api = new OmekaApi;
    $api->setEndpoint('simple_pages');
    $api->setId($id);
    return $api->getData();
  }

  public static function list(){
    $api = new OmekaApi;
    $api->setEndpoint('simple_pages');
    return $api->getData();
  }

  public static function mapSlugToId($slug){
    $pages = self::list();
    dd($pages);

  }

  public static function findBySlug($slug){
    $api = new OmekaApi;
    $api->setEndpoint('simple_pages');
    $id = self::mapSlugToId($slug);
    $api->setId();
    return $api->getData();
  }
}

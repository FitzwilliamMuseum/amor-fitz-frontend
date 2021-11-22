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
}

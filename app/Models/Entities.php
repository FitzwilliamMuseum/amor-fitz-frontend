<?php

namespace App\Models;

use App\OmekaApi;

class Entities
{
  public static function findEntities(array $args)
  {
    $api = new OmekaApi;
    $api->setEndpoint('item_types');
    $api->setArguments(
      $args
    );
    return $api->getData();
  }
}

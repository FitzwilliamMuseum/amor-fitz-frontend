<?php

namespace App\Models;

use App\OmekaApi;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class Tags
{
  public static function getTags()
  {
    $api = new OmekaApi;
    $api->setEndpoint('tags');
    return $api->getData();
  }

  public static function find($id){
    $tagList = self::getTags();
    foreach($tagList as $key => $rep)
      {
          if (in_array($id, $rep)) {
              $tag = $rep['name'];
          }
      }
      return $tag;
  }

  public static function findByTags($tags){
    $tags = explode(',', $tags);
    $search = array();
    $tagList = self::getTags();
    foreach($tags as $tag){
      foreach($tagList as $key => $rep)
        {
            if (in_array($tag, $rep)) {
                $string = $rep['name'];
            }
        }
        $search[] = $string;
    }
    return $search;
  }
}

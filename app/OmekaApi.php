<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use Cache;

class OmekaApi {

  public $_apiUrl = 'https://hayleypapers.fitzmuseum.cam.ac.uk/api/';

  public $_endpoint = '';

  public $_id = NULL;

  public function getApiUrl(){
    return $this->_apiUrl;
  }

  public function setEndpoint($endpoint){
    $this->_endpoint = $endpoint;
    return $this->_endpoint;
  }

  public function getEndPoint(){
    return $this->_endpoint;
  }

  protected $_params;


  public $_args = array();

  public function setArguments($args){
      $this->_args = $args;
      return $this;
    }

  public function getArgs()
  {
    return $this->_args;
  }

  public function buildQuery()
  {
    if(!empty($this->getArgs())){
      return '?' . http_build_query($this->getArgs());
    }
  }

  public function setID($id){
    $this->_id = '/' . $id;
    return $this;
  }

  public function getID()
  {
    if(!is_null($this->_id)){
      return $this->_id;
    }
  }

  public function getCallUrl()
  {
      return $this->getApiUrl() . $this->getEndPoint() . $this->getID() . $this->buildQuery();
  }

  public function getData(){

    $url = $this->getApiUrl() . $this->getEndPoint() . $this->getID() . $this->buildQuery();
    $key = md5($url);
    $expiresAt = now()->addMinutes(20);
    if (Cache::has($key)) {
      $data = Cache::get($key);
    } else {
      $response = Http::get($url);
      $data = $response->json();
      Cache::put($key, $data, $expiresAt);
    }
    return $data;
  }

  public function getUrl($url){
    $key = md5($url);
    $expiresAt = now()->addMinutes(30);
    if (Cache::has($key)) {
      $data = Cache::get($key);
    } else {
      $response = Http::get($url);
      $data = $response->json();
      Cache::put($key, $data, $expiresAt);
    }
    return $data;
  }
}

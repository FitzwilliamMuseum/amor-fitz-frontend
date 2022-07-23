<?php

namespace App;

use Illuminate\Support\Facades\Http;

use Cache;

class OmekaApi
{

    /**
     * @var string
     */
    public string $_apiUrl = 'https://hayleypapers.fitzmuseum.cam.ac.uk/api/';

    /**
     * @var string
     */
    public string $_endpoint = '';

    /**
     * @var string|null
     */
    public ?string $_id = NULL;

    /**
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->_apiUrl;
    }

    /**
     * @param $endpoint
     * @return string
     */
    public function setEndpoint($endpoint): string
    {
        $this->_endpoint = $endpoint;
        return $this->_endpoint;
    }

    /**
     * @return string
     */
    public function getEndPoint(): string
    {
        return $this->_endpoint;
    }

    /**
     * @var array
     */
    public array $_args = array();

    /**
     * @param array $args
     * @return $this
     */
    public function setArguments(array $args): static
    {
        $this->_args = $args;
        return $this;
    }

    /**
     * @return array
     */
    public function getArgs(): array
    {
        return $this->_args;
    }

    /**
     * @return string
     */
    public function buildQuery(): string
    {
        if (!empty($this->getArgs())) {
            return '?' . http_build_query($this->getArgs());
        } else {
            return '';
        }
    }

    /**
     * @param string $id
     * @return $this
     */
    public function setID(string $id): static
    {
        $this->_id = '/' . $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getID(): string
    {
        if (!is_null($this->_id)) {
            return $this->_id;
        } else {
            return '';
        }
    }



    /**
     * @return array
     */
    public function getData(): array
    {
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

    /**
     * @param string $url
     * @return array
     */
    public function getUrl(string $url): array
    {
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

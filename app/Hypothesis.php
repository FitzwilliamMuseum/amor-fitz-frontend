<?php

namespace App;

use Cache;
use Illuminate\Support\Facades\Http;

class Hypothesis
{

    /**
     * Search for annotations.
     * @param $params array See http://h.readthedocs.org/en/latest/api.html#search
     * @param $token Optional authorization token
     * @return array Set of matching annotations
     */
    public static function read($id): array
    {
        $_apiUrl = 'https://api.hypothes.is/api/search?';
        $_annotationBase = 'http://hayleypapers.fitzmuseum.cam.ac.uk/items/show/';
        $args = array('uri' => $_annotationBase . $id);
        $key = md5(implode(',', $args));
        $expiresAt = now()->addMinutes(20);
        if (Cache::has($key)) {
            $data = Cache::get($key);
        } else {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('HYPO_API_KEY'),
                'Accept' => 'application/json',
            ])->get($_apiUrl . http_build_query($args));
            $data = $response->json();
            Cache::put($key, $data, $expiresAt);
        }
        return $data;
    }


}

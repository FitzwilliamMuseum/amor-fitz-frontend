<?php

namespace App\Models;

use App\OmekaApi;

class Pages
{
    /**
     * @param int $id
     * @return array
     */
    public static function find(int $id): array
    {
        $api = new OmekaApi;
        $api->setEndpoint('simple_pages');
        $api->setId($id);
        return $api->getData();
    }

    /**
     * @return array
     */
    public static function list(): array
    {
        $api = new OmekaApi;
        $api->setEndpoint('simple_pages');
        return $api->getData();
    }
}

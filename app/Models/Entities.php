<?php

namespace App\Models;

use App\OmekaApi;

class Entities
{
    /**
     * @param array $args
     * @return array
     */
    public static function findEntities(array $args): array
    {
        $api = new OmekaApi;
        $api->setEndpoint('item_types');
        $api->setArguments(
            $args
        );
        return $api->getData();
    }
}

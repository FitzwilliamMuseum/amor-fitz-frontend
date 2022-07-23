<?php

namespace App\Models;

use App\OmekaApi;

class Tags
{
    /**
     * @return array
     */
    public static function getTags(): array
    {
        $api = new OmekaApi;
        $api->setEndpoint('tags');
        return $api->getData();
    }

    public static function find($id)
    {
        $tag = '';
        $tagList = self::getTags();
        foreach ($tagList as $key => $rep) {
            if (in_array($id, $rep)) {
                $tag = $rep['name'];
            }
        }
        return $tag;
    }

    /**
     * @param $tags
     * @return array
     */
    public static function findByTags($tags): array
    {
        $tags = explode(',', $tags);
        $search = array();
        $tagList = self::getTags();
        $string = '';
        foreach ($tags as $tag) {
            foreach ($tagList as $key => $rep) {
                if (in_array($tag, $rep)) {
                    $string = $rep['name'];
                }
            }
            $search[] = $string;
        }
        return $search;
    }
}

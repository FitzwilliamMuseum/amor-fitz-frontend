<?php

namespace App\Models;

use App\OmekaApi;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class Items
{
    /**
     * [getTags description]
     * @return [type] [description]
     */
    public static function getTags()
    {
        $api = new OmekaApi;
        $api->setEndpoint('tags');
        return $api->getData();
    }

    /**
     * [counts description]
     * @param array $args [description]
     * @return [type]       [description]
     */
    public static function counts(array $args)
    {
        $api = new OmekaApi;
        $api->setEndpoint('items');
        if (array_key_exists('tags', $args)) {
            $tagList = self::getTags();
            foreach ($tagList as $key => $rep) {
                if (in_array($args['tags'], $rep)) {
                    $args['tags'] = $rep['name'];
                }
            }
        }
        $api->setArguments($args);
        return $api->getData();
    }

    /**
     * [findByType description]
     * @param array $args [description]
     * @return [type]       [description]
     */
    public static function findByType(array $args)
    {
        $api = new OmekaApi;
        $api->setEndpoint('items');
        if (array_key_exists('tags', $args)) {
            $tagList = self::getTags();
            foreach ($tagList as $key => $rep) {
                if (in_array($args['tags'], $rep)) {
                    $args['tags'] = $rep['name'];
                }
            }
        }
        $api->setArguments($args);
        $items = $api->getData();
        $letters = array();
        foreach ($items as $item) {
            $data = array();
            foreach ($item['element_texts'] as $element) {
                $data[$element['element']['name']] = str_replace(array("\r", "\n"), ' ', $element['text']);
            }
            $data['id'] = $item['id'];
            $data['created'] = $item['added'];
            $data['modified'] = $item['modified'];
            $data['type'] = $item['item_type']['name'];
            $data['tags'] = $item['tags'];
            if (array_key_exists('url', $item['files'])) {
                $image = new OmekaApi;
                $images = $image->getUrl($item['files']['url']);
                self::array_sort_by_column($images, 'order');
                $data['images'] = $images;
            }
            $relations = new OmekaApi;
            $relations->setEndpoint('itemrelations');
            $relations->setArguments(array('subject_item_id' => $data['id']));
            $rels = $relations->getData();
            $fullData = array();
            foreach ($rels as $rel) {
                $related['property_label'] = $rel['property_label'];
                $entities = new OmekaApi;
                $entities->setEndpoint('items');
                $entities->setid($rel['object_item_id']);
                $entity = $entities->getData();
                if (array_key_exists('id', $entity)) {
                    ;
                    $related['object_item_id'] = $rel['object_item_id'];
                    $related['entityType'] = $entity['item_type']['name'];
                    foreach ($entity['element_texts'] as $element) {
                        $related[$element['element']['name']] = str_replace(array("\r", "\n"), ' ', $element['text']);
                    }
                    if (array_key_exists('url', $entity['files'])) {
                        $image = new OmekaApi;
                        $images = $image->getUrl($entity['files']['url']);
                        self::array_sort_by_column($images, 'order');
                        $related['images'] = $images;
                    }

                }
                $fullData[] = $related;
            }
            $data['expanded'] = $fullData;
            $letters[] = $data;

        }
        return $letters;
    }

    /**
     * [find description]
     * @param int $id [description]
     * @return [type]     [description]
     */
    public static function find(int $id)
    {
        $api = new OmekaApi;
        $api->setEndpoint('items');
        $api->setid($id);
        $item = $api->getData();
        $data = array();
        foreach ($item['element_texts'] as $element) {
            $data[$element['element']['name']] = str_replace(array("\r", "\n"), ' ', $element['text']);
        }
        $data['id'] = $item['id'];
        $data['created'] = $item['added'];
        $data['modified'] = $item['modified'];
        $data['type'] = $item['item_type']['name'];
        $data['tags'] = $item['tags'];
        if (array_key_exists('url', $item['files'])) {
            $image = new OmekaApi;
            $images = $image->getUrl($item['files']['url']);
            self::array_sort_by_column($images, 'order');
            $data['images'] = $images;
        }
        $relations = new OmekaApi;
        $relations->setEndpoint('itemrelations');
        $relations->setArguments(array('subject_item_id' => $data['id']));

        $rels = $relations->getData();

        $fullData = array();
        foreach ($rels as $rel) {
            $related['property_label'] = $rel['property_label'];
            $entities = new OmekaApi;
            $entities->setEndpoint('items');
            $entities->setid($rel['object_item_id']);
            $entity = $entities->getData();


            $related['object_item_id'] = $rel['object_item_id'];
            $related['entityType'] = $entity['item_type']['name'];
            foreach ($entity['element_texts'] as $element) {
                $related[$element['element']['name']] = str_replace(array("\r", "\n"), ' ', $element['text']);
            }
            if (array_key_exists('url', $entity['files'])) {
                $image = new OmekaApi;
                $images = $image->getUrl($entity['files']['url']);
                self::array_sort_by_column($images, 'order');
                $related['images'] = $images;
            }
            $fullData[] = $related;
        }
        $data['expanded'] = $fullData;

        $linked = new OmekaApi;
        $linked->setEndpoint('itemrelations');
        $linked->setArguments(array('object_item_id' => $item['id']));
        $links = $linked->getData();
        $objects = array();
        foreach ($links as $link) {
            // dump($link);
            $object['property_label'] = $link['property_label'];
            $entities = new OmekaApi;
            $entities->setEndpoint('items');
            $entities->setid($link['subject_item_id']);
            $entity = $entities->getData();
            $object['object_item_id'] = $link['subject_item_id'];
            $object['entityType'] = $entity['item_type']['name'];
            foreach ($entity['element_texts'] as $element) {
                $object[$element['element']['name']] = str_replace(array("\r", "\n"), ' ', $element['text']);
            }
            if (array_key_exists('url', $entity['files'])) {
                $image = new OmekaApi;
                $image->setEndpoint('files');
                $image->setArguments(array('item' => $entity['id']));
                $images = $image->getData();
                self::array_sort_by_column($images, 'order');
                $object['images'] = $images;
            }
            $objects[] = $object;;
        }


        $geog = new OmekaApi;
        $geog->setEndpoint('itemrelations');
        $geog->setArguments(array('subject_item_id' => $item['id']));
        $places = $geog->getData();
        $domus = array();
        foreach ($places as $place) {
            $object['property_label'] = $place['property_label'];
            $entities = new OmekaApi;
            $entities->setEndpoint('items');
            $entities->setid($place['object_item_id']);
            $entity = $entities->getData();
            $object['object_item_id'] = $place['object_item_id'];
            $object['entityType'] = $entity['item_type']['name'];
            foreach ($entity['element_texts'] as $element) {
                $object[$element['element']['name']] = str_replace(array("\r", "\n"), ' ', $element['text']);
            }
            if (array_key_exists('url', $entity['files'])) {
                $image = new OmekaApi;
                $image->setEndpoint('files');
                $image->setArguments(array('item' => $entity['id']));
                $images = $image->getData();
                self::array_sort_by_column($images, 'order');
                $object['images'] = $images;
            }
            $domus[] = $object;;
        }

        $data['linked_items'] = $objects;
        $data['linked_subjects'] = $domus;
        return $data;
    }


    public static function array_sort_by_column(&$arr, $col, $dir = SORT_ASC)
    {
        $sort_col = array();
        foreach ($arr as $key => $row) {
            $sort_col[$key] = $row[$col];
        }
        array_multisort($sort_col, $dir, $arr);
    }

    public static function letter(int $id)
    {
        $data = array();
        $api = new OmekaApi;
        $api->setEndpoint('items');
        $api->setid($id);
        $item = $api->getData();
        if(!array_key_exists('id',$item)){
            abort('404', $item['message']);
        }
        $data = array();
        if (array_key_exists('element_texts', $item)) {
            foreach ($item['element_texts'] as $element) {
                $data[$element['element']['name']] = str_replace(array("\r", "\n"), ' ', $element['text']);
            }
        }
        $data['id'] = $item['id'];
        $data['created'] = $item['added'];
        $data['modified'] = $item['modified'];
        $data['type'] = $item['item_type']['name'];
        $data['tags'] = $item['tags'];
        if (array_key_exists('url', $item['files'])) {
            $image = new OmekaApi;
            $images = $image->getUrl($item['files']['url']);
            self::array_sort_by_column($images, 'order');
            $data['images'] = $images;
        }
        $relations = new OmekaApi;
        $relations->setEndpoint('itemrelations');
        $relations->setArguments(array('subject_item_id' => $data['id']));

        $rels = $relations->getData();

        $fullData = array();
        foreach ($rels as $rel) {
            $related['property_label'] = $rel['property_label'];
            $entities = new OmekaApi;
            $entities->setEndpoint('items');
            $entities->setid($rel['object_item_id']);
            $entity = $entities->getData();


            $related['object_item_id'] = $rel['object_item_id'];
            $related['entityType'] = $entity['item_type']['name'];
            foreach ($entity['element_texts'] as $element) {
                $related[$element['element']['name']] = str_replace(array("\r", "\n"), ' ', $element['text']);
            }
            if (array_key_exists('url', $entity['files'])) {
                $image = new OmekaApi;
                $images = $image->getUrl($entity['files']['url']);
                self::array_sort_by_column($images, 'order');
                $related['images'] = $images;
            }
            $fullData[] = $related;
        }
        $data['expanded'] = $fullData;
        return $data;
    }


    public static function letterExpand(array $items)
    {
        $records = array();
        foreach ($items as $item) {
            foreach ($item['element_texts'] as $element) {
                $data[$element['element']['name']] = str_replace(array("\r", "\n"), ' ', $element['text']);
            }
            $data['id'] = $item['id'];
            $data['created'] = $item['added'];
            $data['modified'] = $item['modified'];
            $data['type'] = $item['item_type']['name'];
            $data['tags'] = $item['tags'];

            if (array_key_exists('url', $item['files'])) {
                $image = new OmekaApi;
                $images = $image->getUrl($item['files']['url']);
                self::array_sort_by_column($images, 'order');
                $data['images'] = $images;
            }
            if (array_key_exists('itemrelations', $item['extended_resources'])) {
                $relations = new OmekaApi;
                $data['relations'] = $relations->getUrl($item['extended_resources']['itemrelations']['url']);
                $data['expanded'] = array();
                if (!empty($data['relations'])) {
                    if (array_key_exists(0, $data['relations'])) {
                        foreach ($data['relations'] as $relation) {
                            if (isset($relation['object_item_url'])) {
                                $resource = $relation['object_item_url'];
                            } else {
                                $resource = $relation['subject_item_url'];
                            }
                            $call = new OmekaApi;
                            $response = $call->getUrl($resource);
                            $expanded = array();
                            foreach ($response['element_texts'] as $element) {
                                $expanded[$element['element']['name']] = str_replace(array("\r", "\n"), ' ', $element['text']);
                            }
                            $expanded['property_label'] = $relation['property_label'];
                            $expanded['object_item_id'] = $relation['object_item_id'];
                            $expanded['entityType'] = $response['item_type']['name'];
                            $data['expanded'][] = $expanded;
                        }
                    }
                }
            }
            $records[] = $data;
        }
        return $records;
    }
}

<?php

namespace App\Models;

use App\OmekaApi;
use Illuminate\Support\Str;


class Correspondences
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

    /**
     * @param array $args
     * @return array
     */
    public static function find(array $args): array
    {
        $api = new OmekaApi;
        $api->setEndpoint('items');

        if (array_key_exists('tags', $args)) {
            $args['tags'] = Tags::findByTags($args['tags']);
        }
        $api->setArguments(
            $args
        );
        $letters = self::letterExpand($api->getData());
        $conversations = array();
        $protaganists = array();
        $fromTo = array();
        foreach ($letters as $letter) {
            $protaganists['id'] = $letter['id'];
            $people = array();
            $people['id'] = $letter['id'];
            $people['names'] = array();
            $people['slug'] = array();
            $people['tags'] = $letter['tags'];

            foreach ($letter['expanded'] as $rels) {
                if ($rels['entityType'] === 'Person') {
                    if ($rels['property_label'] === 'Author') {
                        $protaganists['author'] = array(
                            'fullname' => $rels['First Name'] . ' ' . $rels['Last Name'],
                            'role' => $rels['property_label'],
                            'surname' => $rels['Last Name']
                        );
                        $people['slug'][] = Str::slug($rels['First Name'] . ' ' . $rels['Last Name']);
                        $people['names'][] = $rels['First Name'] . ' ' . $rels['Last Name'];
                    }
                    if ($rels['property_label'] === 'Recipient') {
                        $protaganists['Recipient'] = array(
                            'fullname' => $rels['First Name'] . ' ' . $rels['Last Name'],
                            'role' => $rels['property_label'],
                            'surname' => $rels['Last Name']
                        );
                        $people['slug'][] = Str::slug($rels['First Name'] . ' ' . $rels['Last Name']);
                        $people['names'][] = $rels['First Name'] . ' ' . $rels['Last Name'];
                    }
                }
            }
            $fromTo[] = $people;
            $new = array();
            $ids = array();
            foreach ($fromTo as $con) {
                $t = array();
                foreach ($con['tags'] as $tag) {
                    if (str_starts_with($tag['name'], 'Correspondence')) {
                        $t[] = $tag['id'];
                        $ids = $t;
                    }
                }
                $new[] = array(
                    'slug' => implode('-', $con['slug']),
                    'names' => implode('/', $con['names']),
                    'tags' => $ids
                );

            }
            $conversations[] = $protaganists;
        }

        return self::group_assoc($new, 'slug');
    }

    /**
     * @param $array
     * @param $key
     * @return array
     */
    public static function group_assoc($array, $key): array
    {
        $return = array();
        foreach ($array as $v) {
            $return[$v[$key]][] = $v;
        }
        return $return;
    }

    /**
     * @param $arr
     * @param $col
     * @param int $dir
     * @return void
     */
    public static function array_sort_by_column(&$arr, $col, int $dir = SORT_ASC): void
    {
        $sort_col = array();
        foreach ($arr as $key => $row) {
            $sort_col[$key] = $row[$col];
        }

        array_multisort($sort_col, $dir, $arr);
    }

    /**
     * @param array $items
     * @return array
     */
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
                            $resource = $relation['object_item_url'] ?? $relation['subject_item_url'];
                            $call = new OmekaApi;
                            $response = $call->getUrl($resource);
                            if (!empty($response['element_texts'])) {
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
            }
            $records[] = $data;
        }
        return $records;
    }
}

<?php

namespace App\Http\Controllers;

use App\OmekaApi;
use Illuminate\Http\JsonResponse;

class mapsController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function placesGeoJson(): JsonResponse
    {
        $places = new OmekaApi;
        $places->setEndpoint('items');
        $places->setArguments(
            array(
                'item_type' => 'Place'
            )
        );
        $items = $places->getData();
        $features = array();
        $records = array();
        foreach ($items as $item) {
            foreach ($item['element_texts'] as $element) {
                $record[$element['element']['name']] = htmlentities($element['text']);
            }
            $record['id'] = $item['id'];
            $records[] = $record;
        }
        foreach ($records as $record) {
            $data = array(
                'type' => 'Feature',
                'geometry' => array(
                    'type' => 'Point',
                    'coordinates' => array(
                        floatval($record['Longitude']),
                        floatval($record['Latitude'])
                    ),
                    'properties' => array(
                        'title' => $record['Title'],
                        'description' => $record['Description'],
                        'url' => route('entity.detail', $record['id'])
                    )
                ));

            $features[] = $data;
        }
        $geojson = array(
            "type" => "FeatureCollection",
            "features" => $features
        );
        return response()->json($geojson);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function letterplaces(int $id): JsonResponse
    {
        $places = new OmekaApi;
        $places->setEndpoint('itemrelations');
        $places->setArguments(array('subject_item_id' => $id));
        $items = $places->getData();
        $features = array();
        foreach ($items as $item) {
            $place = new OmekaApi;
            $place->setEndpoint('items');
            $place->setid($item['object_item_id']);
            $geo = $place->getData();

            $point = array();


            foreach ($geo['element_texts'] as $entity) {
                $point[$entity['element']['name']] = htmlentities($entity['text']);
            }
            $point['id'] = $item['object_item_id'];
            $features[] = $point;

        }
        $new = array_filter($features, function ($var) {
            return (array_key_exists('Latitude', $var));
        });
        foreach ($new as $record) {
            $data = array(
                'type' => 'Feature',
                'geometry' => array(
                    'type' => 'Point',
                    'coordinates' => array(
                        floatval($record['Longitude']),
                        floatval($record['Latitude'])
                    ),
                    'properties' => array(
                        'title' => $record['Title'],
                        'description' => $record['Description'] ?? 'No description',
                        'url' => route('entity.detail', $record['id'])
                    )
                ));

            $features[] = $data;
        }
        $geojson = array(
            "type" => "FeatureCollection",
            "features" => $features
        );
        return response()->json($geojson);
    }
}

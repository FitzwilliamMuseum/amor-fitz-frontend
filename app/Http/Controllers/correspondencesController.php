<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\OmekaApi;
use App\Hypothesis;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use App\Models\Pages;
use App\Models\Items;
use App\Models\Tags;
use App\Models\Correspondences;
use Illuminate\Pagination\LengthAwarePaginator;

class correspondencesController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $convos = array(
            array(
                'title' => 'Correspondence: Anna Seward',
                'tag' => 57,
                'backgrounds' => array('anna-seward'),
                'names' => array('William Hayley', 'Anna Seward'),
                'count' => 0
            ),
            array(
                'title' => 'Correspondence: Anne Flaxman',
                'tag' => 58,
                'backgrounds' => array('anne-nancy-flaxman'),
                'names' => array('William Hayley', 'Anne Flaxman'),
                'count' => 0
            ),
            array(
                'title' => 'Correspondence: John Flaxman',
                'tag' => 59,
                'backgrounds' => array('john-flaxman'),
                'names' => array('William Hayley', 'John Flaxman'),
                'count' => 0
            ),
            array(
                'title' => 'Correspondence: Thomas Alphonso Hayley',
                'tag' => 60,
                'backgrounds' => array('thomas-alphonso-hayley'),
                'names' => array('William Hayley', 'Thomas Alphonso Hayley'),
                'count' => 0
            ),
            array(
                'title' => 'Correspondence: Eliza Hayley (née Ball)',
                'tag' => 61,
                'backgrounds' => array('eliza-hayley'),
                'names' => array('William Hayley', 'Eliza Hayley (née Ball)'),
                'count' => 0
            )
        );

        $page = Pages::find(4);

        return view('correspondences.index', compact('convos', 'page'));
    }

    /**
     * @param Request $request
     * @return View
     */
    public function letters(Request $request): View
    {
        $perPage = 4;
        $args = array(
            'hasImage' => 1,
            'per_page' => $perPage,
            'page' => $request->get('page', 1),
            'item_type' => 'Letter'
        );
        $records = Items::findByType($args);
        $page = Pages::find(4);
        $counts = Items::counts(array('item_type' => 'Letter'));
        $paginate = new LengthAwarePaginator($records, count($counts), 4);
        $paginate->setPath($request->getBaseUrl());
        return view('correspondences.letters', compact('records', 'page', 'paginate'));
    }

    /**
     * @param $url
     * @return array|mixed
     */
    public function getImages($url): mixed
    {
        $response = Http::get($url);
        return $response->json();
    }

    /**
     * @param $id
     * @return View
     */
    public function letter($id): View
    {
        $annotations = Hypothesis::read($id);
        $data = Items::letter($id);
        return view('correspondences.letter', compact('data', 'annotations'));
    }

    /**
     * @param Request $request
     * @return View
     */
    public function tag(Request $request): View
    {
        $args = array('item_type' => 'Letter', 'tags' => request()->segment(4));
        $convos = Correspondences::find($args);
        $perPage = 4;
        $args = array(
            'hasImage' => 1,
            'per_page' => $perPage,
            'page' => $request->get('page', 1),
            'item_type' => 'Letter',
        );
        $countArgs = array('item_type' => 'Letter');
        if (!is_null(request()->segment(4))) {
            $params = Tags::findByTags(request()->segment(4));
            $args['tags'] = implode(',', $params);
            $countArgs['tags'] = implode(',', $params);
        }
        $records = Items::findByType($args);
        $page = Pages::find(4);
        $counts = Items::counts($countArgs);
        $paginate = new LengthAwarePaginator($records, count($counts), 4);
        $paginate->setPath($request->getBaseUrl());
        $tag = Tags::findByTags(request()->segment(4));
        $param = request()->segment(4);
        return view('correspondences.tag', compact('convos', 'records', 'page', 'paginate', 'tag', 'param'));
    }

    /**
     * @return View
     */
    public function tags(): View
    {
        $tags = Tags::getTags();
        return view('correspondences.tags', compact('tags'));
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function timelineByTag(Request $request)
    {

        if (!is_null(request()->segment(4))) {
            $args = array('item_type' => 'Letter', 'tags' => request()->segment(4));
            $params = Tags::findByTags(request()->segment(4));
            $args['tags'] = implode(',', $params);
            $countArgs['tags'] = implode(',', $params);
        }
        $api = new OmekaApi;
        $api->setEndpoint('items');
        $api->setArguments($args);
        $items = $api->getData();
        $data = array();
        foreach ($items as $item) {
            $record = array();
            foreach ($item['element_texts'] as $element) {
                $record[$element['element']['name']] = str_replace(array("\r", "\n"), ' ', $element['text']);
            }
            $record['id'] = $item['id'];
            $record['created'] = $item['added'];
            $record['modified'] = $item['modified'];
            $record['type'] = $item['item_type']['name'];
            $record['tags'] = $item['tags'];
            if (array_key_exists('url', $item['files'])) {
                $image = new OmekaApi;
                $images = $image->getUrl($item['files']['url']);
                self::array_sort_by_column($images, 'order');
                $record['images'] = $images[0];
            }
            $data[] = $record;
        }
        $page = view('correspondences.json', compact('data', 'params'));
        return response($page)->header('Content-Type', 'application/json');

    }

    /**
     * @param Request $request
     * @return View
     */
    public function timeline(Request $request): View
    {
        if (!is_null(request()->segment(4))) {
            $tags = Tags::findByTags(request()->segment(4));
            $tag = request()->segment(4);
        }
        return view('correspondences.timeline', compact('tags', 'tag'));
    }

    /**
     * @param $arr
     * @param $col
     * @param $dir
     * @return void
     */
    public static function array_sort_by_column(&$arr, $col, $dir = SORT_ASC)
    {
        $sort_col = array();
        foreach ($arr as $key => $row) {
            $sort_col[$key] = $row[$col];
        }
        array_multisort($sort_col, $dir, $arr);
    }
}

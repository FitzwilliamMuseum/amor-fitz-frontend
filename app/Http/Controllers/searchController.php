<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Psr\SimpleCache\InvalidArgumentException;
use Solarium\Client;
use Solarium\Core\Client\Adapter\Curl;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Mews\Purifier\Facades\Purifier;


class searchController extends Controller
{
    private Client $client;

    /**
     * The index page of the search system
     * @return Application|View|Factory
     */
    public function index(): Application|Factory|View
    {
        return view('search.index');
    }

    /** Get results for search
     *
     * @param Request $request
     * @return View
     * @throws ValidationException
     * @throws InvalidArgumentException
     */
    public function results(Request $request): View
    {
        $this->validate($request, [
            'query' => 'required|max:200|min:3',
        ]);
        $queryString = Purifier::clean($request->get('query'), array('HTML.Allowed' => ''));
        $key = md5($queryString . $request->get('page'));
        $perPage = 12;
        $expiresAt = now()->addMinutes(3600);
        $from = ($request->get('page', 1) - 1) * $perPage;
        if (Cache::has($key)) {
            $data = Cache::store('file')->get($key);
        } else {
            $configSolr = Config::get('solarium');
            $this->client = new Client(new Curl(), new EventDispatcher(), $configSolr);
            $query = $this->client->createSelect();
            $query->setQuery($queryString);
            $query->setQueryDefaultOperator('AND');
            $query->setStart($from);
            $query->setRows($perPage);
            $data = $this->client->select($query);
            Cache::store('file')->put($key, $data, $expiresAt);
        }
        $number = $data->getNumFound();
        $records = $data->getDocuments();
        $paginate = new LengthAwarePaginator($records, $number, $perPage);
        $paginate->setPath($request->getBaseUrl() . '?query=' . $queryString);
        return view('search.results', compact('records', 'number', 'paginate', 'queryString'));
    }

    /**
     * @return JsonResponse
     */
    public function ping(): JsonResponse
    {
        $configSolr = Config::get('solarium');
        $this->client = new Client(new Curl(), new EventDispatcher(), $configSolr);
        $ping = $this->client->createPing();
        try {
            $this->client->ping($ping);
            return response()->json('OK');
        } catch (Exception $e) {
            return response()->json('ERROR', 500);
        }
    }
}

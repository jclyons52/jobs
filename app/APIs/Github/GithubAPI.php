<?php

namespace App\APIs\Github;

use App\APIs\BaseAPI;
use App\Transformers\GithubJobTransformer;
use JobApis\Jobs\Client\Providers\GithubProvider;
use JobApis\Jobs\Client\Queries\GithubQuery;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class GithubAPI extends BaseAPI
{
    private $params = [
        'search',
        'lat',
        'long',
        'description',
        'location',
        'full_time'
    ];

    private $defaults = [
        'search' => 'php'
    ];

    public function getJobs($params)
    {
        $filteredParams = $this->filterParams($params);

        $query = new GithubQuery($filteredParams);

        $client = new GithubProvider($query);

        $jobs = collect($client->getJobs()->all());

        $resource = new Collection($jobs, new GithubJobTransformer);

        $fractal = new Manager();

        $array = $fractal->createData($resource)->toArray();
        
        return collect($array['data']);
    }

    protected function getParams(): \Illuminate\Support\Collection
    {
        return collect($this->params);
    }

    protected function getDefauls() : \Illuminate\Support\Collection
    {
        return collect($this->defaults);
    }
}

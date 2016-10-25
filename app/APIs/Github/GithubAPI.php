<?php

namespace App\APIs\Github;

use App\Transformers\GithubJobTransformer;
use Illuminate\Http\Request;
use JobApis\Jobs\Client\Providers\GithubProvider;
use JobApis\Jobs\Client\Queries\GithubQuery;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class GithubAPI
{
    private $params = [
        'search',
        'lat',
        'long',
        'description',
        'location',
        'full_time'
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

    private function filterParams($params)
    {
        $accepted = collect($this->params);

        $given = collect($params);

        return $given->filter(function ($item, $key) use ($accepted) {
            return $accepted->contains($key);
        })->toArray();
    }
}

<?php

namespace App\APIs\Indeed;

use App\APIs\BaseAPI;
use App\Transformers\IndeedJobTransformer;
use JobApis\Jobs\Client\Providers\IndeedProvider;
use JobApis\Jobs\Client\Queries\IndeedQuery;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class IndeedAPI
{
    private $params = [
        'q',
        'l',
        'latlong',
        'co',
    ];

    private $defaults = [
        'co' => 'Australia',
        'q' => 'php'
    ];

    public function getJobs($params)
    {
        $filteredParams = $this->filterParams($params);

        dd($params);

        $query = new IndeedQuery($filteredParams);

        $client = new IndeedProvider($query);

        $jobs = collect($client->getJobs()->all());

        return $jobs;

        $resource = new Collection($jobs, new IndeedJobTransformer());

        $fractal = new Manager();

        $array = $fractal->createData($resource)->toArray();
        
        return collect($array['data']);
    }

    protected function filterParams($params)
    {
        $accepted = collect($this->getParams());

        $given = $this->addDefaults(collect($params));

        $arr = $given->filter(function ($item, $key) use ($accepted) {
            return $accepted->contains($key);
        })->toArray();

        $arr['publisher'] = env('INDEED_KEY');

        return $arr;
    }

    private function addDefaults($params)
    {
        $defaults = $this->getDefauls();

        dd($defaults);

        $params->map(function($item, $key) use ($defaults) {
            
        });

        return $defaults->merge($params);
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

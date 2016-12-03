<?php

namespace App\APIs;

use Illuminate\Support\Collection;

abstract class BaseAPI
{

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

    private function addDefaults(Collection $params) : Collection
    {
        $defaults = $this->getDefauls();

        return $defaults->merge($params);
    }

    abstract protected function getParams(): Collection;

    abstract protected function getDefauls() : Collection;
}
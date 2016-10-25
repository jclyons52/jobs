<?php

namespace App\Utility;

class Pagination
{
    public static function paginate($collection, $page, $baseUrl, $count = 0)
    {
        if ($count === 0) {
            $count = $collection->count();
        }

        $next = $page + 1;
        
        $last = ceil($count / 10);
        
        $nextUrl = $next >= $last ? null : url($baseUrl . $next);

        $prev = $page - 1;
        
        $prevUrl = $prev < 1 ? null : url($baseUrl . $prev);

        return collect([
            "total" => $count,
            "per_page" => 10,
            "current_page" => $page,
            "last_page" => $last ,
            "next_page_url" => $nextUrl,
            "prev_page_url" => $prevUrl,
            "from" => $page * 10 - 9,
            "to" => $page * 10,
            'data' => $collection->toArray()
        ]);
    }
}

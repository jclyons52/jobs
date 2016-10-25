<?php

namespace App;

use App\Utility\Pagination;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Job extends Model
{
    public $fillable = ['title', 'description'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function watchers()
    {
        return $this->belongsToMany(User::class);
    }
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public static function haversineQuery($latitude, $longitude, $radius, $page)
    {
        $items = self::select('jobs.*')
            ->selectRaw('( 6371 * acos( cos( radians(?) ) *
                               cos( radians( lat ) )
                               * cos( radians( lng ) - radians(?)
                               ) + sin( radians(?) ) *
                               sin( radians( lat ) ) )
                             ) AS distance,
                             count(id) as count
                             ', [$latitude, $longitude, $latitude])
            ->havingRaw("distance < ?", [$radius])->get();

        $count = $items->count() == 0 ? 0 : $items[0]['count'];

        $jobs = self::select('jobs.*')
            ->selectRaw('( 6371 * acos( cos( radians(?) ) *
                               cos( radians( lat ) )
                               * cos( radians( lng ) - radians(?)
                               ) + sin( radians(?) ) *
                               sin( radians( lat ) ) )
                             ) AS distance
                             ', [$latitude, $longitude, $latitude])
            ->havingRaw("distance < ?", [$radius])
            ->take(10)
            ->get();

        return Pagination::paginate(
            $jobs,
            $page,
            "/api/v1/jobs/search?lat={$latitude}&lng={$longitude}&radius={$radius}&page=",
            $count
        );
    }
}

<?php

namespace App\Services;

use App\Models\Video;

class SearchService
{
    /**
     * @param string $query
     * @return \Illuminate\Database\Eloquent\Collection
     */

    public function getVideosByQuery(string $query) : object
    {
        return Video::where('title', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->latest()
            ->get();
    }
}

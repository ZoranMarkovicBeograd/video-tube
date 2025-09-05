<?php

namespace App\Http\Controllers;

use App\Services\SearchService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function index(Request $request): View
    {
        $query = $request->input('q');
        $videos = [];

        if ($query) {
            $videos = $this->searchService->getVideosByQuery($query);
        }

        return view('videos.search', compact('videos', 'query'));
    }
}

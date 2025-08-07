<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\VideoLike;
use App\Services\VideoLikeService;
use Illuminate\Http\Request;

class VideoLikeController extends Controller
{
    public function __construct(private VideoLikeService $videoLikeService) {}

    public function like(Video $video)
    {
        $this->videoLikeService->handle($video, auth()->id(), 'like');
        return back();    }

    public function dislike(Video $video)
    {
        $this->videoLikeService->handle($video, auth()->id(), 'dislike');
        return back();
    }
}



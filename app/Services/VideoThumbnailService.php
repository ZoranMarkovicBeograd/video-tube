<?php

namespace App\Services;

use App\Traits\HandlesImageUpload;
use Illuminate\Http\Request;

class VideoThumbnailService
{
    use HandlesImageUpload;

    /**
     * @param Request $request
     * @return string|null
     */
    public function processThumbnail(Request $request): ?string
    {
        if ($request->hasFile('thumbnail')) {
            return $this->uploadImage($request->file('thumbnail'));
        }

        return null;
    }
}


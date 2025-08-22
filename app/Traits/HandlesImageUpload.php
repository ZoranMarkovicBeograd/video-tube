<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait HandlesImageUpload
{
    public function uploadImage(UploadedFile $image, string $folder = 'thumbnails'): string
    {
        $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
        $image->storeAs($folder, $filename, 'public');
        return $folder . '/' . $filename;
    }
}


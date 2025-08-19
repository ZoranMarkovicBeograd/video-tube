<?php

namespace App\Services;

use App\Models\Video;
use App\Models\VideoLike;

class VideoLikeService
{
    public function handle(Video $video, int $userId, string $type): void
    {
        $existing = VideoLike::firstWhere(['video_id' => $video->id, 'user_id' => $userId]);

        if ($existing) {
            if ($existing->type === $type) {
                $existing->delete();
            } else {
                $existing->update(['type' => $type]);
            }
        } else {
            VideoLike::create([
                'video_id' => $video->id,
                'user_id' => $userId,
                'type' => $type,
            ]);
        }
    }
}

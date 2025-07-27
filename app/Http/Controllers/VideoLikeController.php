<?php

namespace App\Http\Controllers;

    use App\Models\Video;
    use App\Models\VideoLike;
    use Illuminate\Http\Request;

class VideoLikeController extends Controller
{
    public function like(Video $video)
    {
        return $this->handleLike($video, 'like');
    }

    public function dislike(Video $video)
    {
        return $this->handleLike($video, 'dislike');
    }

    private function handleLike(Video $video, string $type)
    {
        $user = auth()->user();

        $existing = VideoLike::where('video_id', $video->id)
            ->where('user_id', $user->id)
            ->first();

        if ($existing) {
            if ($existing->type === $type) {
                // Ako je već isti tip, ukloni
                $existing->delete();
            } else {
                // Inače, ažuriraj
                $existing->update(['type' => $type]);
            }
        } else {
            // Nema još, kreiraj
            VideoLike::create([
                'video_id' => $video->id,
                'user_id' => $user->id,
                'type' => $type,
            ]);
        }

        return redirect()->back();
    }
}



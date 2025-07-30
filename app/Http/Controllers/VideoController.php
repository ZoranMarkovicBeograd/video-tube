<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoRequest;
use App\Models\Video;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;


class VideoController extends Controller
{
    public function index()
    {
        // TODO: Move to Route::view
        return view('videos.index');
    }

    public function create()
    {
        // TODO: Move to Route::view
        return view('videos.create');
    }

    public function store(StoreVideoRequest $request)
    {

        $file = $request->file('video');
        $path = $file->store('videos', 'public');

        $slug = Str::slug($request->title);

        $originalSlug = $slug;
        $i = 1;
        while (Video::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $i++;
        }

        Video::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'file_path' => $path,
        ]);

        return redirect()->route('videos.create')->with('success', 'Video je uspešno dodat!');
    }

    public function show(Video $video): View
    {
        $this->authorizeUser($video);

        $video->increment('views');
        return view('videos.show', compact('video'));
    }

    public function edit(Video $video): View
    {
        $this->authorizeUser($video);

        return view('videos.edit', compact('video'));
    }

    public function update(Request $request, Video $video): RedirectResponse
    {
        $this->authorizeUser($video);

        // TODO: Move to validation request, php artisan make:request ImeRequesta
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $video->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('videos.index')->with('success', 'Video je ažuriran.');
    }

    public function destroy(Video $video)
    {
        $this->authorizeUser($video);

        Storage::disk('public')->delete($video->file_path);
        $video->delete();

        return redirect()->route('videos.index')->with('success', 'Video je obrisan.');
    }

    // TODO: Remove this after you create a middleware
    private function authorizeUser(Video $video): void
    {
        // TODO: Move to Middleware
        if (auth()->id() !== $video->user_id) {
            abort(403);
        }
    }
}

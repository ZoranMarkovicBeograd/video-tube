<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\ValidationRequest;
use App\Models\Video;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;


class VideoController extends Controller
{

    public function store(StoreVideoRequest $request) : RedirectResponse
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
        $video->increment('views');
        return view('videos.show', compact('video'));
    }

    public function edit(Video $video): View
    {
        return view('videos.edit', compact('video'));
    }

    public function update(ValidationRequest $request, Video $video): RedirectResponse
    {
        $video->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('videos.index')->with('success', 'Video je ažuriran.');
    }

    public function destroy(Video $video): RedirectResponse
    {
        Storage::disk('public')->delete($video->file_path);
        $video->delete();

        return redirect()->route('videos.index')->with('success', 'Video je obrisan.');
    }

}

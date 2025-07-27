<h2>{{ $video->title }}</h2>
<video width="640" height="360" controls>
    <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
    Vaš browser ne podržava video tag.
</video>
<p>{{ $video->description }}</p>
<a href="{{ route('videos.index') }}">Nazad</a>


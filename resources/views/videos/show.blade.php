<h2>{{ $video->title }}</h2>
<video width="640" height="360" controls>
    <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
    Vaš browser ne podržava video tag.
</video>
<p>{{ $video->description }}</p>

<form action="{{ route('videos.like', $video) }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit">👍 Like</button>
</form>

<form action="{{ route('videos.dislike', $video) }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit">👎 Dislike</button>
</form>

<p>
    Lajkova: {{ $video->likes()->count() }} |
    Dislajkova: {{ $video->dislikes()->count() }}
</p>

<a href="{{ route('videos.index') }}">Nazad</a>


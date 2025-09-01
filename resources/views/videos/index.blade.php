<h2>Svi video snimci</h2>

@auth
    <a href="{{ route('videos.create') }}">➕ Dodaj novi video</a>
    <form action="{{ route('search.index') }}" method="GET">
        <input type="text" name="q" placeholder="Pretraži videe..." value="{{ request('q') }}">
        <button type="submit">🔍</button>
    </form>
@endauth

@foreach($videos as $video)
    <div>
        <h3>{{ $video->title }}</h3>

        @if($video->thumbnail)
            <a href="{{ route('videos.show', $video) }}">
                <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="Thumbnail" width="100">
            </a>
        @endif

        <p>Pregleda: {{ $video->views ?? 0 }}</p>

        <a href="{{ route('videos.show', $video) }}">Pregledaj</a>

        @auth
            @if(auth()->id() === $video->user_id)
                | <a href="{{ route('videos.edit', $video) }}">Izmeni</a>
                <form action="{{ route('videos.destroy', $video) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('Obrisati video?')">Obriši</button>
                </form>
            @endif
        @endauth
    </div>
@endforeach

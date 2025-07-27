<h2>Moji video snimci</h2>

<a href="{{ route('videos.create') }}">➕ Dodaj novi video</a>

@foreach($videos as $video)
    <div>
        <h3>{{ $video->title }}</h3>
        <a href="{{ route('videos.show', $video) }}">Pregledaj</a> |
        <a href="{{ route('videos.edit', $video) }}">Izmeni</a>
        <form action="{{ route('videos.destroy', $video) }}" method="POST" style="display:inline;">
            @csrf @method('DELETE')
            <button type="submit" onclick="return confirm('Obrisati video?')">Obriši</button>
        </form>
    </div>
@endforeach

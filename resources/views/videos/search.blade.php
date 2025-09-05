<h2>Rezultati pretrage za: "{{ $query }}"</h2>

@if(!empty($videos) && $videos->count())
    @foreach($videos as $video)
        <div>
            <h3>{{ $video->title }}</h3>
            <p>{{ Str::limit($video->description, 100) }}</p>
            <a href="{{ route('videos.show', $video) }}">Pregledaj</a>
        </div>
    @endforeach
@else
    <p>Nema rezultata za "{{ $query }}".</p>
@endif

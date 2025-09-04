<h2>Video snimci korisnika: {{ $user->name }}</h2>

<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:16px;">
    @forelse($videos as $video)
        <a href="{{ route('videos.show', $video) }}" style="text-decoration:none;color:inherit;border:1px solid #eee;border-radius:12px;overflow:hidden;display:block;">
            <div style="aspect-ratio:16/9;background:#f3f3f3;">
                @php
                    $thumb = $video->thumbnail
                        ? asset('storage/'.$video->thumbnail)
                        : asset('images/default-thumb.jpg');
                @endphp
                <img src="{{ $thumb }}" alt="Thumbnail" style="width:100%;height:100%;object-fit:cover;">
            </div>
            <div style="padding:10px;">
                <div style="font-weight:600">{{ $video->title }}</div>
                <div style="font-size:12px;color:#666">Pregleda: {{ $video->views ?? 0 }}</div>
            </div>
        </a>
    @empty
        <p>Korisnik još nema videa.</p>
    @endforelse
</div>

<div style="margin-top:16px;">
    {{ $videos->links() }}
</div>


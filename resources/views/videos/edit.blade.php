<h2>Izmeni video</h2>
<form method="POST" action="{{ route('videos.update', $video) }}">
    @csrf @method('PUT')
    <label>Naziv:</label>
    <input type="text" name="title" value="{{ old('title', $video->title) }}" required>
    <br>
    <label>Opis:</label>
    <textarea name="description">{{ old('description', $video->description) }}</textarea>
    <br>
    <button type="submit">Sačuvaj izmene</button>
</form>


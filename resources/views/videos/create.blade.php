<h2>Dodaj novi video</h2>

<a href="{{ route('videos.index') }}">← Nazad na moje video snimke</a><br><br>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

<form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label for="title">Naslov:</label>
    <input type="text" name="title" id="title" value="{{ old('title') }}" required>
    <br>

    <label for="description">Opis (opciono):</label>
    <textarea name="description" id="description">{{ old('description') }}</textarea>
    <br>

    <label for="video">Video fajl (mp4/mov/avi/wmv):</label>
    <input type="file" name="video" id="video" accept="video/*" required>
    <br>

    <button type="submit">Dodaj video</button>
</form>



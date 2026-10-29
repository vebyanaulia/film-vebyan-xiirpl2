<div class="form-group">
  <label for="title">Judul Film</label>
  <input class="form-control" id="title" name="title" value="{{ old('title', $film?->title) }}" required maxlength="255">
</div>
<div class="form-group">
  <label for="genre_id">Genre</label>
  <select class="form-control" id="genre_id" name="genre_id" required>
    <option value="">Pilih genre</option>
    @foreach ($genres as $genre)
      <option value="{{ $genre->id }}" @selected((string) old('genre_id', $film?->genre_id) === (string) $genre->id)>{{ $genre->name }}</option>
    @endforeach
  </select>
</div>
<div class="form-group">
  <label for="year">Tahun</label>
  <input class="form-control" id="year" type="number" name="year" min="1888" max="2100" value="{{ old('year', $film?->year) }}" required>
</div>
<div class="form-group">
  <label for="poster">Path Poster</label>
  <input class="form-control" id="poster" name="poster" value="{{ old('poster', $film?->poster) }}" placeholder="storage/images/c10.jpg" required maxlength="2048">
</div>
<div class="form-group">
  <label for="sinopsis">Sinopsis</label>
  <textarea class="form-control" id="sinopsis" name="sinopsis" rows="6" required>{{ old('sinopsis', $film?->sinopsis) }}</textarea>
</div>
<div class="form-actions">
  <button class="btn btn-primary" type="submit">Simpan</button>
  <a class="btn btn-default" href="{{ route('admin.films.index') }}">Batal</a>
</div>
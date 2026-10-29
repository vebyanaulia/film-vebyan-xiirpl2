<div class="form-group"><label for="name">Nama Cast</label><input class="form-control" id="name" name="name" value="{{ old('name', $cast?->name) }}" required maxlength="45"></div>
<div class="form-group"><label for="age">Usia</label><input class="form-control" id="age" type="number" name="age" value="{{ old('age', $cast?->age) }}" min="0" max="150" required></div>
<div class="form-group"><label for="bio">Bio</label><textarea class="form-control" id="bio" name="bio" rows="6" required>{{ old('bio', $cast?->bio) }}</textarea></div>
<div class="form-actions"><button class="btn btn-warning" type="submit">Simpan</button> <a class="btn btn-default" href="{{ route('admin.casts.index') }}">Batal</a></div>

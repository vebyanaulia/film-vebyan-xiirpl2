@extends('admin.layout')
@section('title', 'Edit Komentar')
@section('header', 'Edit Komentar')
@section('content')
<div class="admin-panel">
  <p><strong>{{ $comment->user?->name ?? 'Guest' }}</strong></p>
  <form method="POST" action="{{ route('admin.comments.update', $comment) }}">@csrf @method('PUT')
    <div class="form-group"><label for="film_id">Film</label><select class="form-control" id="film_id" name="film_id" required>@foreach ($films as $film)<option value="{{ $film->id }}" @selected(old('film_id', $comment->film_id) == $film->id)>{{ $film->title }}</option>@endforeach</select></div>
    <div class="form-group"><label for="rating">Rating</label><input class="form-control" id="rating" type="number" name="rating" min="1" max="10" value="{{ old('rating', $comment->rating) }}" required></div>
    <div class="form-group"><label for="comment">Komentar</label><textarea class="form-control" id="comment" name="comment" rows="6" required>{{ old('comment', $comment->comment) }}</textarea></div>
    <button class="btn btn-warning">Simpan</button> <a class="btn btn-default" href="{{ route('admin.comments.index') }}">Batal</a>
  </form>
</div>
@endsection

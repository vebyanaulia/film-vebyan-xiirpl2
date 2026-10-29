@extends('admin.layout')

@section('title', 'Edit Film')

@section('content')
<div class="admin-panel">
  <h2 style="margin-top: 0;">Edit Film</h2>
  <form action="{{ route('admin.films.update', $film) }}" method="POST">
    @csrf
    @method('PUT')
    @include('admin.films._form')
  </form>
</div>
@endsection
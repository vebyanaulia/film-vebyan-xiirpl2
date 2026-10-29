@extends('admin.layout')

@section('title', 'Tambah Film')

@section('content')
<div class="admin-panel">
  <h2 style="margin-top: 0;">Tambah Film</h2>
  <form action="{{ route('admin.films.store') }}" method="POST">
    @csrf
    @include('admin.films._form', ['film' => null])
  </form>
</div>
@endsection
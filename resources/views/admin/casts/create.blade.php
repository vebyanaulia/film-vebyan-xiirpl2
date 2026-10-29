@extends('admin.layout')
@section('title', 'Tambah Cast')
@section('header', 'Tambah Cast')
@section('content')<div class="admin-panel"><form method="POST" action="{{ route('admin.casts.store') }}">@csrf @include('admin.casts._form', ['cast' => null])</form></div>@endsection

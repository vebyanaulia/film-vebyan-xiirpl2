@extends('admin.layout')
@section('title', 'Tambah User')
@section('header', 'Tambah User')
@section('content')<div class="admin-panel"><form method="POST" action="{{ route('admin.users.store') }}">@csrf @include('admin.users._form', ['user' => null])</form></div>@endsection

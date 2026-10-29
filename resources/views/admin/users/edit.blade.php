@extends('admin.layout')
@section('title', 'Edit User')
@section('header', 'Edit User')
@section('content')<div class="admin-panel"><form method="POST" action="{{ route('admin.users.update', $user) }}">@csrf @method('PUT') @include('admin.users._form')</form></div>@endsection

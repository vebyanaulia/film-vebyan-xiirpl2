@extends('admin.layout')
@section('title', 'Edit Cast')
@section('header', 'Edit Cast')
@section('content')<div class="admin-panel"><form method="POST" action="{{ route('admin.casts.update', $cast) }}">@csrf @method('PUT') @include('admin.casts._form')</form></div>@endsection

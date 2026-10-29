@extends('templates.index')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-5 col-md-offset-3" style="margin-top: 40px; margin-bottom: 40px;">
      <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">Register</h3></div>
        <div class="panel-body">
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul style="margin-bottom: 0;">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="name">Nama / Username</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ old('name', old('username')) }}" required autofocus>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" minlength="8" required>
            </div>
            <div class="form-group">
              <label for="password_confirmation">Konfirmasi Password</label>
              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" minlength="8" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@extends('templates.index')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-5 col-md-offset-3" style="margin-top: 40px; margin-bottom: 40px;">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Login</h3>
        </div>
        <div class="panel-body">
          @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul style="margin-bottom: 0;">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
              <label for="email">Email</label>
              <input
                type="email"
                class="form-control"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Alamat email"
                required
                autofocus
              >
            </div>

            <div class="form-group">
              <label for="password">Password</label>
              <input
                type="password"
                class="form-control"
                id="password"
                name="password"
                placeholder="Kata sandi"
                required
              >
            </div>

            <div class="checkbox">
              <label>
                <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                Ingat saya
              </label>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </form>

          <p class="text-muted" style="margin-top: 15px; margin-bottom: 0;">
            Silakan masuk menggunakan akun yang sudah terdaftar.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

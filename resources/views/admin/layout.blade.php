<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Admin Dashboard') - OneMovies</title>
  <link href="{{ asset('template/css/bootstrap.css') }}" rel="stylesheet">
  <link href="{{ asset('template/css/font-awesome.min.css') }}" rel="stylesheet">
  <style>
    :root { --admin-bg: #0e172b; --admin-sidebar: #1c2a40; --admin-panel: #202f46; --admin-border: #2d3d56; --admin-muted: #93a2ba; --admin-orange: #ff8a0a; }
    * { box-sizing: border-box; }
    body { background: var(--admin-bg); color: #f5f7fb; }
    .admin-shell { min-height: 100vh; display: flex; }
    .admin-sidebar { width: 286px; flex: 0 0 286px; background: var(--admin-sidebar); border-right: 1px solid var(--admin-border); display: flex; flex-direction: column; }
    .admin-brand { height: 88px; display: flex; align-items: center; padding: 0 22px; border-bottom: 1px solid var(--admin-border); color: #fff; font-size: 24px; font-weight: 700; }
    .admin-brand i { color: var(--admin-orange); margin-right: 12px; }
    .admin-brand span { color: var(--admin-orange); }
    .admin-badge { background: rgba(255,138,10,.18); color: var(--admin-orange); border-radius: 12px; font-size: 11px; padding: 4px 9px; margin-left: 10px; }
    .admin-menu { padding: 28px 14px; flex: 1; }
    .admin-menu-label { color: var(--admin-muted); font-size: 11px; font-weight: 700; letter-spacing: .08em; margin: 8px 14px 10px; text-transform: uppercase; }
    .admin-menu a { color: var(--admin-muted); display: block; padding: 13px 15px; border-radius: 9px; margin-bottom: 4px; font-size: 15px; }
    .admin-menu a i { width: 23px; text-align: center; margin-right: 10px; }
    .admin-menu a:hover, .admin-menu a.active { background: var(--admin-orange); color: #fff; text-decoration: none; }
    .admin-menu .logout { color: #ff5b5b; margin-top: 20px; }
    .admin-user { border-top: 1px solid var(--admin-border); padding: 18px 22px; color: #fff; }
    .admin-user-avatar { background: var(--admin-orange); border-radius: 50%; display: inline-flex; height: 38px; width: 38px; align-items: center; justify-content: center; margin-right: 9px; font-weight: 700; }
    .admin-user small { color: var(--admin-orange); display: block; margin-left: 50px; margin-top: -9px; }
    .admin-main { flex: 1; min-width: 0; }
    .admin-topbar { min-height: 88px; padding: 22px 36px; border-bottom: 1px solid var(--admin-border); display: flex; justify-content: space-between; align-items: center; }
    .admin-topbar h1 { font-size: 25px; margin: 0 0 4px; }
    .admin-topbar p { color: var(--admin-muted); margin: 0; }
    .admin-top-actions .btn { margin-left: 8px; }
    .admin-content { padding: 36px; }
    .admin-panel { background: var(--admin-panel); border: 1px solid var(--admin-border); border-radius: 12px; padding: 22px; box-shadow: 0 8px 22px rgba(0,0,0,.12); }
    .admin-panel h2, .admin-panel h3 { color: #fff; }
    .admin-panel .table { color: #f5f7fb; margin-bottom: 0; }
    .admin-panel .table > thead > tr > th { color: var(--admin-muted); border-bottom-color: var(--admin-border); text-transform: uppercase; font-size: 11px; }
    .admin-panel .table > tbody > tr > td { border-top-color: var(--admin-border); }
    .admin-panel .form-control, .admin-panel select, .admin-panel textarea { background: #162238; border-color: var(--admin-border); color: #fff; }
    .stat { border: 1px solid var(--admin-border); min-height: 130px; }
    .stat-number { font-size: 28px; font-weight: 700; }
    .stat-icon { border-radius: 12px; float: left; font-size: 22px; height: 52px; line-height: 52px; margin-right: 15px; text-align: center; width: 52px; }
    .stat-copy { color: var(--admin-muted); padding-top: 5px; }
    .stat-copy .stat-number { color: #fff; }
    .table > tbody > tr > td { vertical-align: middle; }
    .poster-thumb { width: 52px; height: 72px; object-fit: cover; background: #e9ecef; }
    .form-actions { margin-top: 24px; }
    .admin-table-panel { min-height: 365px; }
    .comment-item { border-bottom: 1px solid var(--admin-border); padding: 13px 0; }
    .comment-item:last-child { border-bottom: 0; }
    .comment-item small, .comment-item p { color: var(--admin-muted); }
    @media (max-width: 900px) { .admin-sidebar { width: 220px; flex-basis: 220px; } .admin-content, .admin-topbar { padding-left: 20px; padding-right: 20px; } }
    @media (max-width: 700px) { .admin-shell { display: block; } .admin-sidebar { width: 100%; } .admin-menu { padding: 12px; } .admin-menu a { display: inline-block; margin-right: 4px; } .admin-menu-label, .admin-user { display: none; } .admin-brand { height: 64px; } .admin-topbar { align-items: flex-start; display: block; } .admin-top-actions { margin-top: 14px; } .admin-content { padding: 20px 12px; } }
  </style>
</head>
<body>
  <div class="admin-shell">
    <aside class="admin-sidebar">
      <a class="admin-brand" href="{{ route('admin.dashboard') }}"><i class="fa fa-film"></i>One<span>Movies</span><b class="admin-badge">ADMIN</b></a>
      <nav class="admin-menu">
        <div class="admin-menu-label">Menu Utama</div>
        <a class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a>
        <a class="{{ request()->routeIs('admin.films.*') ? 'active' : '' }}" href="{{ route('admin.films.index') }}"><i class="fa fa-film"></i>Kelola Film</a>
        <a class="{{ request()->routeIs('admin.casts.*') ? 'active' : '' }}" href="{{ route('admin.casts.index') }}"><i class="fa fa-users"></i>Cast &amp; Aktor</a>
        <div class="admin-menu-label" style="margin-top: 25px;">Interaksi &amp; User</div>
        <a class="{{ request()->routeIs('admin.comments.*') ? 'active' : '' }}" href="{{ route('admin.comments.index') }}"><i class="fa fa-comments"></i>Komentar</a>
        <a class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}"><i class="fa fa-user"></i>Kelola User</a>
        <div class="admin-menu-label" style="margin-top: 25px;">Aksi Cepat</div>
        <a href="{{ route('home') }}"><i class="fa fa-external-link"></i>Lihat Website</a>
        <a class="logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('admin-logout').submit();"><i class="fa fa-sign-out"></i>Keluar (Logout)</a>
        <form id="admin-logout" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
      </nav>
      <div class="admin-user"><span class="admin-user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span><strong>{{ Auth::user()->name }}</strong><small><i class="fa fa-shield"></i> Administrator</small></div>
    </aside>
    <div class="admin-main">
      <header class="admin-topbar">
        <div><h1>@yield('header', 'Dashboard Ringkasan')</h1><p>@yield('subtitle', 'Pantau statistik film, cast, komentar, dan aktivitas terkini.')</p></div>
        <div class="admin-top-actions"><a class="btn btn-warning" href="{{ route('admin.films.create') }}"><i class="fa fa-plus"></i> Tambah Film</a><a class="btn btn-default" href="{{ route('home') }}"><i class="fa fa-globe"></i> Buka Website</a></div>
      </header>
      <main class="admin-content">
        @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if ($errors->any())
          <div class="alert alert-danger"><ul style="margin-bottom: 0;">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
        @endif
        @yield('content')
      </main>
    </div>
  </div>
</body>
</html>

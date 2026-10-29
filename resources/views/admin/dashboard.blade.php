@extends('admin.layout')

@section('title', 'Dashboard')
@section('header', 'Dashboard Ringkasan')
@section('subtitle', 'Pantau statistik film, cast, komentar, dan aktivitas terkini.')

@section('content')
<div class="row">
  @foreach ($stats as $stat)
    <div class="col-lg-3 col-sm-6">
      <div class="admin-panel stat" style="margin-bottom: 20px;">
        <div class="stat-icon" style="background: {{ $stat['color'] }}22; color: {{ $stat['color'] }};"><i class="fa {{ $stat['icon'] }}"></i></div>
        <div class="stat-copy">{{ $stat['label'] }}<div class="stat-number">{{ $stat['value'] }}</div></div>
        <div class="clearfix"></div>
      </div>
    </div>
  @endforeach
</div>

<div class="row">
  <div class="col-lg-8">
    <div class="admin-panel admin-table-panel">
      <div class="clearfix">
        <h3 class="pull-left" style="margin-top: 0;">Film Terbaru</h3>
        <a class="btn btn-default btn-sm pull-right" href="{{ route('admin.films.index') }}">Lihat Semua ({{ $filmCount }})</a>
      </div>
      <div class="table-responsive">
        <table class="table">
          <thead><tr><th>Poster</th><th>Judul</th><th>Genre</th><th>Tahun</th><th>Aksi</th></tr></thead>
          <tbody>
            @forelse ($latestFilms as $film)
              <tr>
                <td><img class="poster-thumb" src="{{ asset($film->poster) }}" alt="{{ $film->title }}"></td>
                <td><strong>{{ $film->title }}</strong></td>
                <td><span class="label label-warning">{{ $film->genre?->name ?? '-' }}</span></td>
                <td><span class="label label-default">{{ $film->year }}</span></td>
                <td>
                  <a class="btn btn-default btn-xs" href="{{ route('admin.films.edit', $film) }}"><i class="fa fa-pencil"></i></a>
                  <a class="btn btn-default btn-xs" href="{{ route('movies.show', $film) }}"><i class="fa fa-eye"></i></a>
                </td>
              </tr>
            @empty
              <tr><td colspan="5">Belum ada film.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="admin-panel admin-table-panel">
      <h3 style="margin-top: 0;">Komentar Terbaru <a class="btn btn-default btn-xs pull-right" href="{{ route('admin.dashboard') }}">Semua</a></h3>
      @forelse ($latestComments as $comment)
        <div class="comment-item">
          <strong>{{ $comment->user?->name ?? 'Pengguna tidak dikenal' }}</strong>
          <span class="label label-warning pull-right"><i class="fa fa-star"></i> {{ $comment->rating }}</span>
          <small class="clearfix">pada film: <b style="color: var(--admin-orange);">{{ $comment->film?->title ?? '-' }}</b></small>
          <p style="margin: 6px 0 0;">{{ \Illuminate\Support\Str::limit($comment->comment, 80) }}</p>
          <small>{{ $comment->created_at?->diffForHumans() ?? $comment->created_at?->format('d M Y') }}</small>
        </div>
      @empty
        <p class="comment-item">Belum ada komentar.</p>
      @endforelse
    </div>
  </div>
</div>
@endsection

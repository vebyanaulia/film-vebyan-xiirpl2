@extends('admin.layout')

@section('title', 'Kelola Film')

@section('content')
<div class="admin-panel">
  <div class="clearfix">
    <h2 class="pull-left" style="margin-top: 0;">Kelola Film</h2>
    <a class="btn btn-primary pull-right" href="{{ route('admin.films.create') }}">Tambah Film</a>
  </div>
  <form class="form-inline" method="GET" action="{{ route('admin.films.index') }}" style="margin: 20px 0;">
    <div class="form-group">
      <label class="sr-only" for="search">Cari film</label>
      <input class="form-control" id="search" type="search" name="search" value="{{ request('search') }}" placeholder="Cari judul atau tahun">
    </div>
    <button class="btn btn-default" type="submit">Cari</button>
    @if (request('search')) <a class="btn btn-link" href="{{ route('admin.films.index') }}">Reset</a> @endif
  </form>

  <div class="table-responsive">
    <table class="table table-striped">
      <thead><tr><th>Poster</th><th>Judul</th><th>Genre</th><th>Tahun</th><th class="text-right">Aksi</th></tr></thead>
      <tbody>
        @forelse ($films as $film)
          <tr>
            <td><img class="poster-thumb" src="{{ asset($film->poster) }}" alt="{{ $film->title }}"></td>
            <td>{{ $film->title }}</td>
            <td>{{ $film->genre?->name ?? '-' }}</td>
            <td>{{ $film->year }}</td>
            <td class="text-right">
              <a class="btn btn-xs btn-default" href="{{ route('admin.films.edit', $film) }}">Edit</a>
              <form action="{{ route('admin.films.destroy', $film) }}" method="POST" style="display: inline;" onsubmit="return confirm('Hapus film ini?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-xs btn-danger" type="submit">Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="5" class="text-center">Film tidak ditemukan.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  {{ $films->links() }}
</div>
@endsection
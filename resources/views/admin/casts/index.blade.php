@extends('admin.layout')
@section('title', 'Cast & Aktor')
@section('header', 'Cast & Aktor')
@section('subtitle', 'Kelola data pemeran film.')
@section('content')
<div class="admin-panel">
  <div class="clearfix"><h2 class="pull-left" style="margin-top: 0;">Daftar Cast & Aktor</h2><a class="btn btn-warning pull-right" href="{{ route('admin.casts.create') }}"><i class="fa fa-plus"></i> Tambah Cast</a></div>
  <form class="form-inline" method="GET" action="{{ route('admin.casts.index') }}" style="margin: 20px 0;"><input class="form-control" name="search" value="{{ request('search') }}" placeholder="Cari nama cast"><button class="btn btn-default" type="submit">Cari</button></form>
  <div class="table-responsive"><table class="table"><thead><tr><th>Nama</th><th>Usia</th><th>Bio</th><th>Aksi</th></tr></thead><tbody>
    @forelse ($casts as $cast)
      <tr><td><strong>{{ $cast->name }}</strong></td><td>{{ $cast->age }}</td><td>{{ \Illuminate\Support\Str::limit($cast->bio, 90) }}</td><td><a class="btn btn-default btn-xs" href="{{ route('admin.casts.edit', $cast) }}">Edit</a><form style="display:inline" method="POST" action="{{ route('admin.casts.destroy', $cast) }}" onsubmit="return confirm('Hapus cast ini?');">@csrf @method('DELETE')<button class="btn btn-danger btn-xs">Hapus</button></form></td></tr>
    @empty
      <tr><td colspan="4">Belum ada data cast.</td></tr>
    @endforelse
  </tbody></table></div>
  {{ $casts->links() }}
</div>
@endsection

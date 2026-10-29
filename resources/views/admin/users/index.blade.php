@extends('admin.layout')
@section('title', 'Kelola User')
@section('header', 'Kelola User')
@section('subtitle', 'Kelola akun dan role pengguna.')
@section('content')
<div class="admin-panel">
  <div class="clearfix"><h2 class="pull-left" style="margin-top: 0;">Daftar User</h2><a class="btn btn-warning pull-right" href="{{ route('admin.users.create') }}"><i class="fa fa-plus"></i> Tambah User</a></div>
  <form class="form-inline" method="GET" action="{{ route('admin.users.index') }}" style="margin: 20px 0;"><input class="form-control" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email"><button class="btn btn-default" type="submit">Cari</button></form>
  <div class="table-responsive"><table class="table"><thead><tr><th>Nama</th><th>Email</th><th>Role</th><th>Terdaftar</th><th>Aksi</th></tr></thead><tbody>
    @forelse ($users as $user)
      <tr><td><strong>{{ $user->name }}</strong>@if ($user->is(auth()->user())) <span class="label label-info">Anda</span>@endif</td><td>{{ $user->email }}</td><td><span class="label {{ $user->role === 'admin' ? 'label-warning' : 'label-default' }}">{{ $user->role }}</span></td><td>{{ $user->created_at?->format('d M Y') }}</td><td><a class="btn btn-default btn-xs" href="{{ route('admin.users.edit', $user) }}">Edit</a>@unless ($user->is(auth()->user()))<form style="display:inline" method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Hapus user ini?');">@csrf @method('DELETE')<button class="btn btn-danger btn-xs">Hapus</button></form>@endunless</td></tr>
    @empty
      <tr><td colspan="5">Belum ada user.</td></tr>
    @endforelse
  </tbody></table></div>
  {{ $users->links() }}
</div>
@endsection

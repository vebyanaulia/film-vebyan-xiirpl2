@extends('admin.layout')
@section('title', 'Komentar')
@section('header', 'Kelola Komentar')
@section('subtitle', 'Moderasi ulasan dan komentar pengguna.')
@section('content')
<div class="admin-panel">
  <h2 style="margin-top: 0;">Daftar Komentar</h2>
  <form class="form-inline" method="GET" action="{{ route('admin.comments.index') }}" style="margin: 20px 0;"><input class="form-control" name="search" value="{{ request('search') }}" placeholder="Cari komentar, user, atau film"><button class="btn btn-default" type="submit">Cari</button></form>
  <div class="table-responsive"><table class="table"><thead><tr><th>User</th><th>Film</th><th>Komentar</th><th>Rating</th><th>Aksi</th></tr></thead><tbody>
    @forelse ($comments as $comment)
      <tr><td>{{ $comment->user?->name ?? 'Pengguna tidak dikenal' }}</td><td>{{ $comment->film?->title ?? '-' }}</td><td>{{ \Illuminate\Support\Str::limit($comment->comment, 100) }}<br><small>{{ $comment->created_at?->diffForHumans() ?? $comment->created_at?->format('d M Y') }}</small></td><td><span class="label label-warning">{{ $comment->rating }}/10</span></td><td><a class="btn btn-default btn-xs" href="{{ route('admin.comments.edit', $comment) }}">Edit</a><form style="display:inline" method="POST" action="{{ route('admin.comments.destroy', $comment) }}" onsubmit="return confirm('Hapus komentar ini?');">@csrf @method('DELETE')<button class="btn btn-danger btn-xs">Hapus</button></form></td></tr>
    @empty
      <tr><td colspan="5">Belum ada komentar.</td></tr>
    @endforelse
  </tbody></table></div>
  {{ $comments->links() }}
</div>
@endsection

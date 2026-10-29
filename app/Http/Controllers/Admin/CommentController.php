<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Kritik;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $comments = Kritik::with(['user', 'film'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();
                $query->where('comment', 'like', "%{$search}%")
                    ->orWhereHas('user', fn ($user) => $user->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('film', fn ($film) => $film->where('title', 'like', "%{$search}%"));
            })
            ->latest()->paginate(10)->withQueryString();

        return view('admin.comments.index', compact('comments'));
    }

    public function edit(Kritik $comment)
    {
        return view('admin.comments.edit', ['comment' => $comment->load(['user', 'film']), 'films' => Film::orderBy('title')->get()]);
    }

    public function update(Request $request, Kritik $comment)
    {
        $comment->update($request->validate([
            'comment' => ['required', 'string', 'max:5000'],
            'rating' => ['required', 'integer', 'min:1', 'max:10'],
            'film_id' => ['required', 'integer', 'exists:films,id'],
        ]));

        return redirect()->route('admin.comments.index')->with('success', 'Komentar berhasil diperbarui.');
    }

    public function destroy(Kritik $comment)
    {
        $comment->delete();

        return redirect()->route('admin.comments.index')->with('success', 'Komentar berhasil dihapus.');
    }
}
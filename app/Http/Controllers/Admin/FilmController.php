<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFilmRequest;
use App\Http\Requests\UpdateFilmRequest;
use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function index(Request $request)
    {
        $films = Film::with('genre')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('year', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.films.index', compact('films'));
    }

    public function create()
    {
        return view('admin.films.create', ['genres' => Genre::orderBy('name')->get()]);
    }

    public function store(StoreFilmRequest $request)
    {
        Film::create($request->validated());

        return redirect()->route('admin.films.index')->with('success', 'Film berhasil ditambahkan.');
    }

    public function edit(Film $film)
    {
        return view('admin.films.edit', [
            'film' => $film,
            'genres' => Genre::orderBy('name')->get(),
        ]);
    }

    public function update(UpdateFilmRequest $request, Film $film)
    {
        $film->update($request->validated());

        return redirect()->route('admin.films.index')->with('success', 'Film berhasil diperbarui.');
    }

    public function destroy(Film $film)
    {
        $film->delete();

        return redirect()->route('admin.films.index')->with('success', 'Film berhasil dihapus.');
    }
}
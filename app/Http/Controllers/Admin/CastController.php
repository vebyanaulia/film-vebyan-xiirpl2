<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cast;
use Illuminate\Http\Request;

class CastController extends Controller
{
    public function index(Request $request)
    {
        $casts = Cast::when($request->filled('search'), fn ($query) => $query->where('name', 'like', '%'.$request->string('search').'%'))
            ->latest()->paginate(10)->withQueryString();

        return view('admin.casts.index', compact('casts'));
    }

    public function create()
    {
        return view('admin.casts.create', ['cast' => null]);
    }

    public function store(Request $request)
    {
        Cast::create($this->validated($request));

        return redirect()->route('admin.casts.index')->with('success', 'Cast berhasil ditambahkan.');
    }

    public function edit(Cast $cast)
    {
        return view('admin.casts.edit', compact('cast'));
    }

    public function update(Request $request, Cast $cast)
    {
        $cast->update($this->validated($request));

        return redirect()->route('admin.casts.index')->with('success', 'Cast berhasil diperbarui.');
    }

    public function destroy(Cast $cast)
    {
        $cast->delete();

        return redirect()->route('admin.casts.index')->with('success', 'Cast berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:45'],
            'age' => ['required', 'integer', 'min:0', 'max:150'],
            'bio' => ['required', 'string', 'max:5000'],
        ]);
    }
}
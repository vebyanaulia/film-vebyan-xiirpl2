<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cast;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Kritik;
use App\Models\User;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $stats = [
            ['label' => 'Total Film', 'value' => Film::count(), 'icon' => 'fa-film', 'color' => '#ff8a0a'],
            ['label' => 'Total Cast / Aktor', 'value' => Cast::count(), 'icon' => 'fa-users', 'color' => '#347cf7'],
            ['label' => 'Total Genre', 'value' => Genre::count(), 'icon' => 'fa-tags', 'color' => '#00b894'],
            ['label' => 'Total Ulasan/Komentar', 'value' => Kritik::count(), 'icon' => 'fa-comments', 'color' => '#a855f7'],
            ['label' => 'Pengguna Terdaftar', 'value' => User::count(), 'icon' => 'fa-user', 'color' => '#347cf7'],
        ];

        return view('admin.dashboard', [
            'stats' => $stats,
            'filmCount' => $stats[0]['value'],
            'latestFilms' => Film::with('genre')->latest()->limit(5)->get(['id', 'title', 'poster', 'year', 'genre_id']),
            'latestComments' => Kritik::with(['user', 'film'])->latest()->limit(5)->get(),
        ]);
    }
}
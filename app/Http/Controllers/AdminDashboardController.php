<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $roleCounts = User::query()
            ->selectRaw('role, COUNT(*) as total')
            ->groupBy('role')
            ->pluck('total', 'role');

        $users = User::query()
            ->latest('id')
            ->limit(12)
            ->get(['id', 'name', 'email', 'role', 'created_at']);

        return view('Admin.dashboard', [
            'roleCounts' => $roleCounts,
            'users' => $users,
            'totalUsers' => User::query()->count(),
        ]);
    }
}

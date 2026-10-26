@extends('Admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="app-wrapper">
    <nav class="app-header navbar navbar-expand bg-body">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button" aria-label="Toggle sidebar">
                        <i class="bi bi-list"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-md-block"><a href="{{ route('home') }}" class="nav-link">View site</a></li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><span class="nav-link">{{ auth()->user()->name }}</span></li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="d-flex">
                        @csrf
                        <button type="submit" class="nav-link">Log out</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}" class="brand-link">
                <img src="{{ asset('admin-tema/assets/img/AdminLTELogo.png') }}" alt="Admin dashboard" class="brand-image opacity-75 shadow">
                <span class="brand-text fw-light">Clean Blog Admin</span>
            </a>
        </div>
        <div class="sidebar-wrapper">
            <nav class="mt-2">
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                            <i class="nav-icon bi bi-speedometer2"></i><p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#users" class="nav-link">
                            <i class="nav-icon bi bi-people"></i><p>Users</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link">
                            <i class="nav-icon bi bi-house"></i><p>Back to site</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6"><h3 class="mb-0">Dashboard</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="alert alert-warning" role="alert">
                    <i class="bi bi-shield-exclamation me-1"></i>
                    Demo dashboard: login and role-based access are not enabled yet. This page is read-only.
                </div>

                <div class="row">
                    <div class="col-xl-2 col-md-4 col-6">
                        <div class="small-box text-bg-primary">
                            <div class="inner"><h3>{{ $totalUsers }}</h3><p>Total users</p></div>
                            <i class="small-box-icon bi bi-people"></i>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6">
                        <div class="small-box text-bg-success">
                            <div class="inner"><h3>{{ $roleCounts->get('subscriber', 0) }}</h3><p>Subscribers</p></div>
                            <i class="small-box-icon bi bi-person"></i>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6">
                        <div class="small-box text-bg-warning">
                            <div class="inner"><h3>{{ $roleCounts->get('editor', 0) }}</h3><p>Editors</p></div>
                            <i class="small-box-icon bi bi-pencil-square"></i>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6">
                        <div class="small-box text-bg-danger">
                            <div class="inner"><h3>{{ $roleCounts->get('moderator', 0) }}</h3><p>Moderators</p></div>
                            <i class="small-box-icon bi bi-shield-check"></i>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6">
                        <div class="small-box text-bg-dark">
                            <div class="inner"><h3>{{ $roleCounts->get('admin', 0) }}</h3><p>Admins</p></div>
                            <i class="small-box-icon bi bi-person-fill-lock"></i>
                        </div>
                    </div>
                </div>

                <div class="card mb-4" id="users">
                    <div class="card-header">
                        <h3 class="card-title">Recent users</h3>
                        <div class="card-tools"><span class="badge text-bg-primary">{{ $totalUsers }} total</span></div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped align-middle mb-0">
                                <thead>
                                    <tr><th>Name</th><th>Email</th><th>Role</th><th>Joined</th></tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @php
                                                    $roleBadge = match ($user->role) {
                                                        'admin' => 'text-bg-danger',
                                                        'moderator' => 'text-bg-warning',
                                                        'editor' => 'text-bg-primary',
                                                        default => 'text-bg-secondary',
                                                    };
                                                @endphp
                                                <span class="badge {{ $roleBadge }}">{{ ucfirst($user->role) }}</span>
                                            </td>
                                            <td>{{ $user->created_at?->format('M j, Y') ?? '—' }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="4" class="text-center py-4">No users yet. Run <code>php artisan db:seed --class=DemoUserSeeder</code> to add demo accounts.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-body-secondary">Showing up to 12 most recently created users.</div>
                </div>
            </div>
        </div>
    </main>

    <footer class="app-footer"><strong>Clean Blog</strong> · Admin dashboard preview</footer>
</div>
@endsection

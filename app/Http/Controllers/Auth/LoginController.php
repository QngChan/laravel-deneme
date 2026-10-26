<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function create(): View
    {
        $demoEmails = collect();

        if ($this->demoLoginIsEnabled()) {
            $demoEmails = User::query()
                ->where('is_demo', true)
                ->orderBy('email')
                ->pluck('email');
        }

        return view('Auth.login', compact('demoEmails'));
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::query()->where('email', $credentials['email'])->first();
        $demoLoginIsAllowed = $this->demoLoginIsEnabled();

        if ($user?->is_demo && ! $demoLoginIsAllowed) {
            return back()
                ->withErrors(['email' => 'The provided credentials do not match our records.'])
                ->onlyInput('email');
        }

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withErrors(['email' => 'The provided credentials do not match our records.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('home'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    private function demoLoginIsEnabled(): bool
    {
        return app()->environment('local')
            && (bool) config('demo.auth_enabled')
            && filled(config('demo.shared_password'));
    }
}

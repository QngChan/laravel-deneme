@extends('Pages.Layouts.master')

@section('title', 'Log in | Clean Blog')

@section('page-header')
<header class="masthead" style="background-image: url('{{ asset('tema/assets/img/home-bg.jpg') }}')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="page-heading"><h1>Log in</h1><span class="subheading">Welcome back</span></div>
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
<main class="mb-5">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <p>Log in to your account to continue.</p>

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($demoEmails->isNotEmpty())
                    <div class="alert alert-info" role="note">
                        Local demo accounts share the password configured as <code>DEMO_SHARED_PASSWORD</code> in your <code>.env</code> file. Choose any sample email below.
                    </div>
                @endif

                <form method="POST" action="{{ route('login.store') }}" class="my-4">
                    @csrf
                    <div class="form-floating mb-3">
                        <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" value="{{ old('email') }}" placeholder="name@example.com" autocomplete="username" list="demo-emails" required autofocus>
                        <label for="email">Email address</label>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        @if ($demoEmails->isNotEmpty())
                            <datalist id="demo-emails">
                                @foreach ($demoEmails as $demoEmail)
                                    <option value="{{ $demoEmail }}"></option>
                                @endforeach
                            </datalist>
                        @endif
                    </div>

                    <label for="password" class="form-label">Password</label>
                    <div class="input-group mb-3">
                        <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password" autocomplete="current-password" required>
                        <button class="btn btn-outline-secondary" type="button" data-password-toggle="password" aria-label="Show password" aria-pressed="false">Show</button>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" id="remember" name="remember" type="checkbox" value="1" @checked(old('remember'))>
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>

                    <button class="btn btn-primary text-uppercase" type="submit">Log in</button>
                </form>
                <p>New here? <a href="{{ route('register') }}">Create an account</a>.</p>
            </div>
        </div>
    </div>
</main>
@endsection

@section('page-scripts')
<script>
    document.querySelectorAll('[data-password-toggle]').forEach((button) => {
        button.addEventListener('click', () => {
            const input = document.getElementById(button.dataset.passwordToggle);
            const showPassword = input.type === 'password';
            input.type = showPassword ? 'text' : 'password';
            button.textContent = showPassword ? 'Hide' : 'Show';
            button.setAttribute('aria-label', showPassword ? 'Hide password' : 'Show password');
            button.setAttribute('aria-pressed', String(showPassword));
        });
    });
</script>
@endsection

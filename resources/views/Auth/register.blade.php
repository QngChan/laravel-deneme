@extends('Pages.Layouts.master')

@section('title', 'Register | Clean Blog')

@section('page-header')
<header class="masthead" style="background-image: url('{{ asset('tema/assets/img/contact-bg.jpg') }}')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="page-heading"><h1>Create an account</h1><span class="subheading">Join the community</span></div>
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
                <p>Create your account. New accounts start with the subscriber role.</p>

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <p class="mb-1">Please review the following:</p>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register.store') }}" class="my-4">
                    @csrf
                    <div class="form-floating mb-3">
                        <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Your name" autocomplete="name" maxlength="255" required autofocus>
                        <label for="name">Name</label>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" value="{{ old('email') }}" placeholder="name@example.com" autocomplete="email" maxlength="255" required>
                        <label for="email">Email address</label>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <label for="password" class="form-label">Password</label>
                    <div class="input-group mb-2">
                        <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password" autocomplete="new-password" aria-describedby="password-guidelines" required>
                        <button class="btn btn-outline-secondary" type="button" data-password-toggle="password" aria-label="Show password" aria-pressed="false">Show</button>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-text mb-3" id="password-guidelines">
                        Use at least 12 characters, including uppercase and lowercase letters, a number, and a symbol.
                    </div>

                    <label for="password_confirmation" class="form-label">Confirm password</label>
                    <div class="input-group mb-4">
                        <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required>
                        <button class="btn btn-outline-secondary" type="button" data-password-toggle="password_confirmation" aria-label="Show password confirmation" aria-pressed="false">Show</button>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input @error('terms') is-invalid @enderror" id="terms" name="terms" type="checkbox" value="1" @checked(old('terms')) required>
                        <label class="form-check-label" for="terms">
                            I agree to the <a href="#termsModal" data-bs-toggle="modal">Terms of Service</a>.
                        </label>
                        @error('terms')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <button class="btn btn-primary text-uppercase" type="submit">Create account</button>
                </form>
                <p>Already registered? <a href="{{ route('login') }}">Log in</a>.</p>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="termsModalLabel">Sample Terms of Service</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Demonstration text only:</strong> these sample terms are placeholders for this learning project and are not legal advice or a production agreement.</p>
                <p>By creating an account, you agree to use this demo site respectfully, provide accurate account details, and avoid actions that disrupt the site or other visitors.</p>
                <p>Content and features may change while the project is being developed. Do not submit confidential, sensitive, or payment information through this demo.</p>
                <p>This project is provided for demonstration purposes without guarantees of uninterrupted availability. A complete service would publish reviewed terms and a privacy notice before public launch.</p>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div>
        </div>
    </div>
</div>
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

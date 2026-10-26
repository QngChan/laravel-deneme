# Authentication Pages and Demo Login Design

## Goal

Add functional login and registration pages under `resources/views/Auth`, let the existing demo accounts sign in during local development, and protect the admin dashboard with authentication and an admin role check.

## User experience

- `/login` uses the existing Clean Blog theme and standard email and password fields.
- During local development only, the seeded demo accounts use one shared password configured through `.env`; users still enter the selected account's email. The shared password is never a production fallback.
- `/register` collects a name, email, password, confirmation, and required Terms of Service acceptance. Terms are clearly dummy/sample text.
- Registration validates a password of at least 12 characters with uppercase, lowercase, numeric, and symbol characters. The page lists these rules and has accessible show/hide controls for password fields.
- New registrations always receive the `subscriber` role. The request cannot assign a privileged role.
- Login and registration have links to one another. Authenticated users can log out through a CSRF-protected POST route.

## Data and security

- Add an `is_demo` flag to users so local shared-password login only applies to seeded demo accounts.
- Demo credentials are configured outside source code and only enabled when `APP_ENV=local`. Seeded accounts use the configured shared password when present; otherwise their passwords remain random.
- Normal authentication uses Laravel's session guard and hashed passwords. Successful login regenerates the session; logout invalidates it and regenerates the CSRF token.
- Login and registration routes are rate limited. Validation errors are shown without revealing whether an email is registered.
- Protect `/admin` with `auth` plus an admin-role middleware. Registration always assigns subscriber.
- Add guest/auth navigation controls to the existing shared site header.

## Out of scope

- Password reset and email verification.
- Admin user-management actions.
- Production support for the shared demo password.

## Acceptance checks

- Login, registration, and logout routes render and work through the database-backed user model.
- The strong password rule and required terms acceptance are enforced server-side.
- A registration cannot choose `editor`, `moderator`, or `admin`.
- Local seeded demo users can log in with their email and configured shared password; that shortcut fails outside local development.
- Guests cannot access `/admin`; authenticated non-admin users receive 403; the seeded admin can view it.
- The compiled Blade views load without errors.

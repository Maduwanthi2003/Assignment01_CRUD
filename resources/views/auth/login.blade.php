<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebAdmin | Login</title>

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <link rel="icon" type="image/svg+xml" href="{{ asset('laravel-icon.svg') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Pacifico&display=swap" rel="stylesheet">
</head>
<body>

<main class="login-page">

    <section class="login-container">

        <!-- LEFT LOGIN PANEL -->
        <div class="login-left">

            <div class="brand">
                <svg class="brand-shield" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor"
                     stroke-width="2.2" stroke-linejoin="round">
                    <path d="M12 2 20 5v6c0 5-3.5 8.5-8 11-4.5-2.5-8-6-8-11V5l8-3Z"/>
                </svg>

                <span>WebAdmin</span>
            </div>

            <div class="user-avatar">
                <svg viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.8"
                     stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="7" r="4"/>
                    <path d="M4 22v-2a8 8 0 0 1 16 0v2"/>
                </svg>
            </div>

            <form method="POST"
                  action="{{ route('login.submit') }}"
                  class="login-form">

                @csrf

                @if ($errors->any())
                    <div class="error-message" role="alert">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="input-group">
                    <svg viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.8"
                         stroke-linecap="round">
                        <circle cx="12" cy="7" r="4"/>
                        <path d="M4 21a8 8 0 0 1 16 0"/>
                    </svg>

                    <input type="email"
                           name="email"
                           aria-label="Email"
                           placeholder="Email"
                           value="{{ old('email') }}"
                           autocomplete="username"
                           required>
                </div>

                <div class="input-group">
                    <svg viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.8"
                         stroke-linecap="round"
                         stroke-linejoin="round">
                        <rect x="5" y="10" width="14"
                              height="11" rx="2"/>
                        <path d="M8 10V7a4 4 0 0 1 8 0v3"/>
                        <path d="M12 15v2"/>
                    </svg>

                    <input type="password"
                           name="password"
                           aria-label="Password"
                           placeholder="Password"
                           autocomplete="current-password"
                           required>
                </div>

                <button type="submit" class="login-btn">
                    LOGIN
                </button>

                <label class="remember-me">
                    <input type="checkbox"
                           name="remember"
                           value="1"
                           {{ old('remember') ? 'checked' : '' }}>
                    <span>Remember me</span>
                </label>

                <div class="login-footer">
                    Authorised staff only
                </div>

            </form>

        </div>

        <!-- RIGHT HELLO PANEL -->
        <div class="login-right">

            <div class="hello-content">

                <div class="hello-art">
                    <span class="shape triangle-one"></span>
                    <span class="shape triangle-two"></span>
                    <span class="shape circle-one"></span>
                    <span class="shape circle-two"></span>

                    <h1 class="hello-text">Hello<span class="hello-dot">.</span></h1>
                </div>

                <p class="hello-description">
                    Sign in to manage your users, customers and<br class="desktop-break">
                    products.
                </p>

            </div>

        </div>

    </section>

</main>

</body>
</html>

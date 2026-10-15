<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit User | WebAdmin</title>

    <link rel="icon" type="image/svg+xml"
          href="{{ asset('laravel-icon.svg') }}">

    <link rel="stylesheet"
          href="{{ asset('css/users.css') }}">

    <link rel="stylesheet"
          href="{{ asset('css/user-create.css') }}">

    <script src="{{ asset('js/users.js') }}" defer></script>
</head>

<body>
<div class="app-layout">

    <aside class="sidebar" id="sidebar">

        <div class="sidebar-brand">
            <svg viewBox="0 0 24 24">
                <path d="M12 2 20 5v6c0 5-3.5 8.5-8 11-4.5-2.5-8-6-8-11V5l8-3Z"/>
            </svg>
            <div>
                <h2>WebAdmin</h2>
                <small>Manage Your Website</small>
            </div>
        </div>

        <nav class="sidebar-nav">

            <a href="{{ route('dashboard') }}" class="nav-link">
                <svg viewBox="0 0 24 24">
                    <path d="m3 10 9-7 9 7v10H3z"/>
                    <path d="M9 20v-7h6v7"/>
                </svg>
                <span>Dashboard</span>
            </a>

            <div class="nav-group open">
                <button type="button"
                        class="nav-link nav-toggle active"
                        aria-expanded="true">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="7" r="4"/>
                        <path d="M4 21a8 8 0 0 1 16 0"/>
                    </svg>
                    <span>Users</span>
                    <span class="plus">−</span>
                </button>

                <div class="submenu">
                    <a href="{{ route('users.index') }}"
                       class="submenu-link selected">All Users</a>

                    <a href="{{ route('users.create') }}"
                       class="submenu-link">Add User</a>
                </div>
            </div>

            <div class="nav-group">
                <button type="button"
                        class="nav-link nav-toggle"
                        aria-expanded="false">
                    <svg viewBox="0 0 24 24">
                        <circle cx="9" cy="8" r="3"/>
                        <circle cx="17" cy="9" r="2"/>
                        <path d="M3 20a6 6 0 0 1 12 0"/>
                        <path d="M16 15a5 5 0 0 1 5 5"/>
                    </svg>
                    <span>Customers</span>
                    <span class="plus">+</span>
                </button>
                <div class="submenu">
                    <a href="{{ route('customers.index') }}" class="submenu-link">All Customers</a>
                    <a href="{{ route('customers.create') }}" class="submenu-link">Add Customer</a>
                </div>
            </div>

            <div class="nav-group">
                <button type="button"
                        class="nav-link nav-toggle"
                        aria-expanded="false">
                    <svg viewBox="0 0 24 24">
                        <path d="m12 2 9 5v10l-9 5-9-5V7z"/>
                        <path d="m3 7 9 5 9-5"/>
                        <path d="M12 12v10"/>
                    </svg>
                    <span>Products</span>
                    <span class="plus">+</span>
                </button>
                <div class="submenu">
                    <a href="{{ route('products.index') }}" class="submenu-link">All Products</a>
                    <a href="{{ route('products.create') }}" class="submenu-link">Add Product</a>
                </div>
            </div>
        </nav>

        <form method="POST"
              action="{{ route('logout') }}"
              class="logout-form">
            @csrf
            <button type="submit">
                <svg viewBox="0 0 24 24">
                    <path d="M10 4H5v16h5"/>
                    <path d="M13 8l5 4-5 4"/>
                    <path d="M8 12h10"/>
                </svg>
                <span>Logout</span>
            </button>
        </form>
    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="main-wrapper">

        <header class="page-header">
            <div class="header-title">
                <button type="button"
                        class="mobile-menu"
                        id="menuButton"
                        aria-label="Open menu"
                        aria-expanded="false">☰</button>

                <div>
                    <h1>Edit User</h1>
                    <p>Update user details below</p>
                </div>
            </div>

            <div class="admin-profile">
                <span class="admin-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </span>
                <span class="admin-name">
                    {{ auth()->user()->name }}
                </span>
            </div>
        </header>

        <main class="user-create-content">
            <section class="user-form-card">

                <h2>Edit User Details</h2>

                @if($errors->any())
                    <div class="validation-summary" role="alert">
                        <strong>Please correct the following:</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST"
                      action="{{ route('users.update', $user) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-grid">

                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   value="{{ old('name', $user->name) }}"
                                   maxlength="255"
                                   required>
                            @error('name')
                                <small class="field-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   value="{{ old('email', $user->email) }}"
                                   maxlength="255"
                                   required>
                            @error('email')
                                <small class="field-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password"
                                   id="password"
                                   name="password"
                                   placeholder="Leave blank to keep current"
                                   autocomplete="new-password">
                            @error('password')
                                <small class="field-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">
                                Confirm Password
                            </label>
                            <input type="password"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   placeholder="Confirm new password"
                                   autocomplete="new-password">
                        </div>

                    </div>

                    <div class="form-actions">
                        <button type="submit" class="save-btn">
                            Update
                        </button>

                        <a href="{{ route('users.index') }}"
                           class="cancel-btn">
                            Cancel
                        </a>
                    </div>
                </form>
            </section>
        </main>
    </div>
</div>
</body>
</html>

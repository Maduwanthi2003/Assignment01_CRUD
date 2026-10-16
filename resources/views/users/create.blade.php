<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Add User | WebAdmin</title>

    <link rel="icon"
          type="image/svg+xml"
          href="{{ asset('laravel-icon.svg') }}">

    <link rel="stylesheet"
          href="{{ asset('css/users.css') }}">

    <link rel="stylesheet"
          href="{{ asset('css/user-create.css') }}">

    <script src="{{ asset('js/users.js') }}" defer></script>
</head>

<body>

<div class="app-layout">

    <!-- SIDEBAR -->
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

                <nav class="sidebar-nav" aria-label="Main navigation">

            <!-- DASHBOARD -->
            <a href="{{ route('dashboard') }}"
               class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">

                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="m3 10 9-7 9 7v10H3z"/>
                    <path d="M9 20v-7h6v7"/>
                </svg>

                <span>Dashboard</span>
            </a>

            <!-- USERS (ADMIN ONLY) -->
            @if(auth()->user() && auth()->user()->role === 'admin')
            <a href="{{ route('users.index') }}"
               class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">

                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="7" r="4"/>
                    <path d="M4 21a8 8 0 0 1 16 0"/>
                </svg>

                <span>Users</span>
            </a>
            @endif

            <!-- CUSTOMERS -->
            <a href="{{ route('customers.index') }}"
               class="nav-link {{ request()->routeIs('customers.*') ? 'active' : '' }}">

                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="9" cy="8" r="3"/>
                    <circle cx="17" cy="9" r="2"/>
                    <path d="M3 20a6 6 0 0 1 12 0"/>
                    <path d="M16 15a5 5 0 0 1 5 5"/>
                </svg>

                <span>Customers</span>
            </a>

            <!-- PRODUCTS -->
            <a href="{{ route('products.index') }}"
               class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">

                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="m12 2 9 5v10l-9 5-9-5V7z"/>
                    <path d="m3 7 9 5 9-5"/>
                    <path d="M12 12v10"/>
                </svg>

                <span>Products</span>
            </a>

        </nav>

        <!-- LOGOUT -->
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

    <!-- MOBILE OVERLAY -->
    <div class="sidebar-overlay"
         id="sidebarOverlay"></div>

    <!-- MAIN WRAPPER -->
    <div class="main-wrapper">

        <!-- PAGE HEADER -->
        <header class="page-header">

            <div class="header-title">

                <button type="button"
                        class="mobile-menu"
                        id="menuButton"
                        aria-label="Open menu"
                        aria-expanded="false">
                    ☰
                </button>

                <div>
                    <h1>Add User</h1>
                    <p>Fill in the details below</p>
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

        <!-- ADD USER CONTENT -->
        <main class="user-create-content">

            <section class="user-form-card">

                <h2>Add User Details</h2>

                <!-- VALIDATION ERRORS -->
                @if($errors->any())
                    <div class="validation-summary"
                         role="alert">
                        <strong>Please correct the following:</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- FORM -->
                <form method="POST"
                      action="{{ route('users.store') }}">

                    @csrf

                    <div class="form-grid">

                        <!-- FULL NAME -->
                        <div class="form-group">

                            <label for="name">
                                Full Name
                            </label>

                            <input type="text"
                                   id="name"
                                   name="name"
                                   value="{{ old('name') }}"
                                   placeholder="Enter full name"
                                   maxlength="255"
                                   autocomplete="name"
                                   required>

                            @error('name')
                                <small class="field-error">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                        <!-- EMAIL -->
                        <div class="form-group">

                            <label for="email">
                                Email
                            </label>

                            <input type="email"
                                   id="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   placeholder="name@example.com"
                                   maxlength="255"
                                   autocomplete="off"
                                   required>

                            @error('email')
                                <small class="field-error">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                        <!-- ROLE -->
                        <div class="form-group">

                            <label for="role">
                                Role
                            </label>

                            <select id="role"
                                    name="role"
                                    required>
                                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="manager" {{ old('role') === 'manager' ? 'selected' : '' }}>Manager</option>
                                <option value="staff" {{ old('role', 'staff') === 'staff' ? 'selected' : '' }}>Staff</option>
                            </select>

                            @error('role')
                                <small class="field-error">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                        <!-- PASSWORD -->
                        <div class="form-group">

                            <label for="password">
                                Password
                            </label>

                            <input type="password"
                                   id="password"
                                   name="password"
                                   placeholder="Minimum 8 characters"
                                   minlength="8"
                                   autocomplete="new-password"
                                   required>

                            @error('password')
                                <small class="field-error">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                        <!-- CONFIRM PASSWORD -->
                        <div class="form-group">

                            <label for="password_confirmation">
                                Confirm Password
                            </label>

                            <input type="password"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   placeholder="Confirm password"
                                   minlength="8"
                                   autocomplete="new-password"
                                   required>

                        </div>

                    </div>

                    <!-- FORM BUTTONS -->
                    <div class="form-actions">

                        <button type="submit"
                                class="save-btn">
                            Save
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
